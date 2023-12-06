<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/include.php");

global $USER;
    $arGroups = $USER->GetUserGroupArray();
if(count(array_intersect (array('1', '5'), $arGroups)) == 0) $APPLICATION->AuthForm(GetMessage("ACCESS_DENIED"));
CPageOption::SetOptionString("main", "nav_page_in_session", "N");
if ($_GET['excel'] != 'y')
{
	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/sale/prolog.php");
	$APPLICATION->SetTitle("Самые ожидаемые товары");
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
}

if (isset($_REQUEST['count']) && isset($_REQUEST['SHOWALL_1']) && ($_REQUEST['count'] == 0) && ($_REQUEST['SHOWALL_1'] == 0))
	LocalRedirect($APPLICATION->GetCurPageParam('', array('count')));


if (isset($_REQUEST['del_filter']))
	LocalRedirect($APPLICATION->GetCurPageParam('', array('del_filter', 'set_filter', 'section', 'lid', 'date_to', 'date_from')));

$res = CSite::GetList($by='sort', $order='asc');
while ($arSite = $res->GetNext())
	$arSites[ $arSite['LID'] ] = $arSite;

$arSections = array();
$res = CIBlockSection::GetList(
	array('LEFT_MARGIN' => 'ASC'),
	array(
		'IBLOCK_ID' => 26,
	),
	false,
	array('*')
);
while ($arSection = $res->GetNext())
{
	$arSections[] = $arSection;
}

$arOrderFilter = array(
	'ORDER_ID' => NULL,
	'SUBSCRIBE' => 'Y'
);

if (count($arSites[$_REQUEST['lid']]) > 0)
{
	$arOrderFilter['LID'] = $_REQUEST['lid'];
}
else
	$arOrderFilter['LID'] = 's1';

if (strlen($_REQUEST['date_from']) > 0)
{
	$arOrderFilter['>=DATE_UPDATE'] = date('d.m.Y H:i:s', strtotime($_REQUEST['date_from']));
}
if (strlen($_REQUEST['date_to']) > 0)
{
	$arOrderFilter['<=DATE_UPDATE'] = date('d.m.Y H:i:s', strtotime($_REQUEST['date_to']));
}

$res = CSaleBasket::GetList(
	array(),
	$arOrderFilter,
	false,
	false,
	array('ID', 'PRODUCT_ID', 'SUBSCRIBE', 'USER_ID', 'LID', 'DATE_INSERT', 'DATE_UPDATE', '*')
);
$arItems = array();
while ($arItem = $res->GetNext())
{
	$productID = $arItem['PRODUCT_ID'];
	$arItems[$productID]['USERS']++;
}

$arSorts = array(
	'id' => 'ID',
	'name' => 'NAME',
	'art' => 'PROPERTY_CML2_ARTICLE',
	'size' => 'PROPERTY_RAZMER'
);

$sortParam = in_array($_REQUEST['sort'], array_keys($arSorts)) ? $_REQUEST['sort'] : 'art';
$sortDir = ($_REQUEST['dir'] == 'desc') ? 'desc' : 'asc';
$arProducts = array();
if (count($arItems) > 0)
{
	$arProductsFilter = array(
		'IBLOCK_ID' => 26,
		'ID' => array_keys($arItems)
	);
	
	if ((isset($_REQUEST['section']) && (count($_REQUEST['section']) > 0)))
	{
		$arProductsFilter['SECTION_ID'] = $_REQUEST['section'];
		$arProductsFilter['INCLUDE_SUBSECTIONS'] = 'Y';
	}
	
	if ($_GET['excel'] == 'y')
		$arNav = false;
	else
	{
		if (isset($_REQUEST['count']) && $_REQUEST['count'] == 0)
		{
			$_REQUEST['SHOWALL_1'] = 1;
		}
		elseif (!isset($_REQUEST['count']))
			$_REQUEST['count'] = 100;
		$arNav = array(
			'nPageSize' => $_REQUEST['count'],
			'iNumPage' => $_REQUEST['PAGEN_1'],
			'bShowAll' => $_REQUEST['SHOWALL_1'],
		);
	}
	
	
	$res = CIBlockElement::GetList(
		array($arSorts[$sortParam] => $sortDir),
		$arProductsFilter,
		false,
		$arNav,
		array('ID', 'IBLOCK_ID', 'NAME', 'PROPERTY_CML2_ARTICLE', 'PROPERTY_RAZMER', 'IBLOCK_SECTION_ID')
	);
	$NavString = $res->GetPageNavStringEx($navComponentObject, '', 'arrows_adm', true);
	while ($arProduct = $res->Fetch())
	{
		$productID = $arProduct['ID'];
		$arProducts[$productID]['NAME'] = $arProduct['NAME'];
		$arProducts[$productID]['ARTICLE'] = $arProduct['PROPERTY_CML2_ARTICLE_VALUE'];
		$arProducts[$productID]['SIZE'] = $arProduct['PROPERTY_RAZMER_VALUE'];
		$arProducts[$productID]['USERS'] = $arItems[$productID]['USERS'];
	}
}


if ($_GET['excel'] == 'y')
{
	ini_set('mbstring.func_overload', '0');
	
	//инициализация PHPExcel
	include_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/classes/PHPExcel.php';
	$objPHPExcel = new PHPExcel();

	/*$objPHPExcel->setActiveSheetIndex(0);
	include_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/classes/PHPExcel/Cell/AdvancedValueBinder.php';
	PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );*/
	
	$arColumnsName = array(
		'ID товара',
		'Наименование товара',
		'Артикул',
		'Размер',
		'Кол-во подписок',
	);

	$sheet = $objPHPExcel->getActiveSheet();
	foreach($arColumnsName as $iCol => $colName)
	{
		//$sheet->setCellValueByColumnAndRow($iCol, 1, iconv('CP1251', 'UTF-8', $colName));
		$sheet->setCellValueByColumnAndRow($iCol, 1, $colName);
	}
	
	$i = 2;
	$totalCount = 0;
	//запись в файл
	foreach($arProducts as $productID => $arProduct)
	{
		$totalCount += $arProduct['USERS'];
		$sheet->getCellByColumnAndRow (0,$i)->setValueExplicit($productID, PHPExcel_Cell_DataType::TYPE_STRING2);
		$sheet->getCellByColumnAndRow (1,$i)->setValueExplicit($arProduct['NAME'], PHPExcel_Cell_DataType::TYPE_STRING2);
		$sheet->getCellByColumnAndRow (2,$i)->setValueExplicit($arProduct['ARTICLE'], PHPExcel_Cell_DataType::TYPE_STRING2);
		$sheet->getCellByColumnAndRow (3,$i)->setValueExplicit($arProduct['SIZE'], PHPExcel_Cell_DataType::TYPE_STRING2);
		$sheet->getCellByColumnAndRow (4,$i)->setValueExplicit($arProduct['USERS'], PHPExcel_Cell_DataType::TYPE_STRING2);
		$i++;
	}
	
	$sheet->getCellByColumnAndRow (0,$i)->setValueExplicit('Всего:', PHPExcel_Cell_DataType::TYPE_STRING2);
	$sheet->getCellByColumnAndRow (4,$i)->setValueExplicit($totalCount, PHPExcel_Cell_DataType::TYPE_STRING2);
	$i++;
	
	
	$arLetters = range('A', 'E');
	foreach($arLetters as $letter)
		$objPHPExcel->getActiveSheet()->getColumnDimension($letter)->setAutoSize(true);


	$objPHPExcel->getActiveSheet()->getStyle('A1:E'.$i)->getAlignment()->setWrapText(true);
	$filename = 'report';

	/*header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
	header('Cache-Control: max-age=0');*/
	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	$objWriter->save($_SERVER['DOCUMENT_ROOT'].'/upload/report.xlsx');
	//$objWriter->save('php://output');
	echo '<a href="/upload/report.xlsx">Скачать файл экспорта</a><br /><br />';
	echo '<a href="'.$APPLICATION->GetCurPageParam('', array('excel')).'">Вернуться</a>';
}
else
{
	?>
		<style type="text/css">
			.adm-list-table-header .adm-list-table-cell{
				height: auto;
				padding: 2px;
			}

			.reports-grouping-table {width: 100%; border-collapse: collapse;}
			.reports-grouping-table thead .reports-grouping-table-head-row,
			.reports-grouping-table tbody .reports-grouping-group-row,
			.reports-grouping-table tbody .reports-grouping-total-row{
				font-weight: bold;
			}
			.reports-grouping-table .reports-grouping-table-row-separator{
				border: 0;
				font-size: 0;
			}
			.reports-grouping-table .reports-grouping-table-row-separator td {border: 0; background-color: transparent;}
			.reports-grouping-table tr td{border: 1px solid #89979D; background-color: white;}
			.reports-grouping-table td.align-right {text-align: right;}
			.reports-grouping-table td.align-left {text-align: left;}
			.reports-grouping-table td.align-center {text-align: center;}
			.adm-list-table-header {cursor: auto;}
			.reports-grouping-table .reports-grouping-group-row td.adm-list-table-cell{
				background: none #E0E9EC;
				border-color: #89979D;
			}
		</style>


		<form id="report-rewrite-filter" action="/bitrix/admin/creports.php" method="GET">
			<input type="hidden" name="sort" value="<?=$_REQUEST['sort']?>" />
			<input type="hidden" name="dir" value="<?=$_REQUEST['dir']?>" />
			<table class="adm-filter-main-table">
				<tr>
					<td class="adm-filter-main-table-cell">
						<div id="filter-tabs" class="adm-filter-tabs-block">
							<span class="adm-filter-tab adm-filter-tab-active" style="cursor: default;">Фильтр</span>
						</div>
					</td>
				</tr>
				<tr>
					<td class="adm-filter-main-table-cell">
						<div class="adm-filter-content">
							<div class="adm-filter-content-table-wrap">
								<table cellspacing="0" class="adm-filter-content-table" style="display: table;">
									<tr>
										<td class="adm-filter-item-left">Отчёт по магазину:</td>
										<td class="adm-filter-item-center">
											<div class="adm-filter-alignment">
												<div class="adm-filter-box-sizing">
													<span class="adm-select-wrap">
														<select class="adm-select" id="sale-site-filter" name="lid">
															<?foreach($arSites as $arSite):?>
																<?
																$selected = false;
																if (($_REQUEST['lid'] == $arSite['LID']) || (!isset($_REQUEST['lid']) && ($arSite['DEF'] == 'Y')))
																	$selected = true;
																?>
																<option <?if ($selected):?>selected="1"<?endif;?> value="<?=$arSite['LID']?>"><?=$arSite['NAME']?></option>
															<?endforeach;?>
														</select>
													</span>
												</div>
											</div>
										</td>
										<td class="adm-filter-item-right"></td>
									</tr>
									<tr>
										<td class="adm-filter-item-left">Отчет за период:</td>
										<td class="adm-filter-item-center">
											<div class="adm-filter-alignment adm-calendar-block">
												<div class="adm-filter-box-sizing">
													<!-- filter date from -->
													<div class="adm-input-wrap adm-calendar-inp adm-calendar-first">
														<input type="text" value="<?=$_REQUEST['date_from']?>" name="date_from" id="reports_date_from" class="adm-input adm-calendar-from">
														<img onclick="BX.calendar({node:this, field:'reports_date_from', form: '', bTime: false, bHideTime: false});" title="Выбрать дату в календаре" class="adm-calendar-icon">
													</div>
													<!-- filter separator -->
													<span class="adm-calendar-separate"></span>
													<!-- filter date to -->
													<div class="adm-input-wrap adm-calendar-second">
														<input type="text" value="<?=$_REQUEST['date_to']?>" name="date_to" id="reports_date_to" class="adm-input adm-calendar-to">
														<img onclick="BX.calendar({node:this, field:'reports_date_to', form: '', bTime: false, bHideTime: false});" title="Выбрать дату в календаре" class="adm-calendar-icon">
													</div>
												</div>
											</div>
										</td>
										<td class="adm-filter-item-right"></td>
									</tr>
								<tr class="chfilter-field-Bitrix\Sale\Section adm-report-chfilter-control" callback="RTFilter_chooseBoolean">
										<td class="adm-filter-item-left">Категория товара:</td>
										<td class="adm-filter-item-center">
											<div class="adm-filter-alignment">
												<div class="adm-filter-box-sizing">
												<span class="adm-select-wrap-multiple">
													<select class="adm-select-multiple sale-report-site-dependent" id="section_filter_reports" name="section[]" caller="true" tid="Section" multiple="multiple" size="7">
														<option value="">Не учитывать</option>
														<?foreach($arSections as $arSection):?>
															<?
															$selected = false;
															if (in_array($arSection['ID'], $_REQUEST['section']))
																$selected = true;
															?>
															<option value="<?=$arSection['ID']?>" <?if ($selected):?>selected="1"<?endif;?>><?=str_repeat('&nbsp;.', $arSection['DEPTH_LEVEL']).' '.$arSection['NAME']?></option>
														<?endforeach;?>
													</select>
												</span>
											</div>
											</div>
										</td>
										<td class="adm-filter-item-right"></td>
									</tr>
								</table>
							</div>
							<div id="tbl_sale_transact_filter_bottom_separator" class="adm-filter-bottom-separate" style="display: block;"></div>
							<div class="adm-filter-bottom">
								<span id="report-rewrite-filter-button" class="adm-btn-wrap"><input type="submit" value="Найти" title="Найти" name="set_filter" class="adm-btn"></span>
								<span id="report-reset-filter-button" class="adm-btn-wrap"><input type="submit" value="Отмена" title="Отмена" name="del_filter" class="adm-btn"></span>
							</div>
						</div>
					</td>
				</tr>
			</table>
		</form>
		<br />
		<a href="<?=$APPLICATION->GetCurPageParam('excel=y');?>" class="adm-btn" title="">Экспорт Excel</a>
		<br />
		<br />
		<?=$NavString?>
		<form action="<?=$APPLICATION->GetCurPageParam('', array('PAGEN_1', 'SHOWALL_1', 'count'))?>" method="get">
			<input type="hidden" name="sort" value="<?=$_REQUEST['sort']?>" />
			<input type="hidden" name="dir" value="<?=$_REQUEST['dir']?>" />
			<input type="hidden" name="lid" value="<?=$_REQUEST['lid']?>" />
			<input type="hidden" name="date_from" value="<?=$_REQUEST['date_from']?>" />
			<input type="hidden" name="date_to" value="<?=$_REQUEST['date_to']?>" />
			<?foreach($_REQUEST['section'] as $sectID):?>
				<input type="hidden" name="section[]" value="<?=$sectID?>" />
			<?endforeach;?>
			<input type="hidden" name="set_filter" value="<?=$_REQUEST['set_filter']?>" />
			<?
			$arSizes = array(
				'10' => '10',
				'20' => '20',
				'50' => '50',
				'100' => '100',
				'200' => '200',
				'500' => '500',
				'0' => 'все',
			);
			?>
			<div class="adm-nav-pages-number-block">
				<span class="adm-nav-pages-number-text" style="padding-top: 5px;">На странице:</span>
				<select name="count" class="adm-select" onchange="$(this).closest('form').submit();" style="padding-right: 0px;">
					<?foreach($arSizes as $size => $sizeText):?>
						<?$selected = ($_REQUEST['count'] == $size)? 'selected="selected"' : '';?>
						<option value="<?=$size?>" <?=$selected?>><?=$sizeText?></option>
					<?endforeach;?>
				</select>
			</div>
		</form>
		<table class="reports-grouping-table">
			<thead>
				<tr class="adm-list-table-header reports-grouping-table-head-row">
					<td class="adm-list-table-cell">
						ID товара
						<a href="<?=$APPLICATION->GetCurPageParam('sort=id&dir=asc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9650;</a>
						<a href="<?=$APPLICATION->GetCurPageParam('sort=id&dir=desc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9660;</a>
					</td>
					<td class="adm-list-table-cell align-center">
						Наименование товара
						<a href="<?=$APPLICATION->GetCurPageParam('sort=name&dir=asc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9650;</a>
						<a href="<?=$APPLICATION->GetCurPageParam('sort=name&dir=desc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9660;</a>
					</td>
					<td class="adm-list-table-cell align-center">
						Артикул
						<a href="<?=$APPLICATION->GetCurPageParam('sort=art&dir=asc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9650;</a>
						<a href="<?=$APPLICATION->GetCurPageParam('sort=art&dir=desc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9660;</a>
					</td>
					<td class="adm-list-table-cell align-center">
						Размер
						<a href="<?=$APPLICATION->GetCurPageParam('sort=size&dir=asc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9650;</a>
						<a href="<?=$APPLICATION->GetCurPageParam('sort=size&dir=desc', array('sort', 'dir', 'PAGEN_1', 'SHOWALL_1'))?>">&#9660;</a>
					</td>
					<td class="adm-list-table-cell align-center">Кол-во подписок</td>
				</tr>
			</thead>
			<tbody>
				<?$totalCount = 0;?>
				<?foreach($arProducts as $productID => $arItem):?>
					<?$totalCount += $arItem['USERS'];?>
					<tr class="adm-list-table-header reports-grouping-data-row">
						<td><?=$productID?></td>
						<td><?=$arItem['NAME']?></td>
						<td><?=$arItem['ARTICLE']?></td>
						<td><?=$arItem['SIZE']?></td>
						<td class="align-right"><?=$arItem['USERS']?></td>
					</tr>
				<?endforeach;?>
				<tr class="adm-list-table-header reports-grouping-total-row">
					<td class="adm-list-table-cell">Всего:</td>
					<td class="adm-list-table-cell">&nbsp;</td>
					<td class="adm-list-table-cell">&nbsp;</td>
					<td class="adm-list-table-cell">&nbsp;</td>
					<td class="adm-list-table-cell align-right"><?=$totalCount?></td>
				</tr>
			</tbody>
			
		</table>
		<?=$NavString?>
		<form action="<?=$APPLICATION->GetCurPageParam('', array('PAGEN_1', 'SHOWALL_1', 'count'))?>" method="get">
			<input type="hidden" name="sort" value="<?=$_REQUEST['sort']?>" />
			<input type="hidden" name="dir" value="<?=$_REQUEST['dir']?>" />
			<input type="hidden" name="lid" value="<?=$_REQUEST['lid']?>" />
			<input type="hidden" name="date_from" value="<?=$_REQUEST['date_from']?>" />
			<input type="hidden" name="date_to" value="<?=$_REQUEST['date_to']?>" />
			<?foreach($_REQUEST['section'] as $sectID):?>
				<input type="hidden" name="section[]" value="<?=$sectID?>" />
			<?endforeach;?>
			<input type="hidden" name="set_filter" value="<?=$_REQUEST['set_filter']?>" />
			<div class="adm-nav-pages-number-block">
				<span class="adm-nav-pages-number-text" style="padding-top: 5px;">На странице:</span>
				<select name="count" class="adm-select" onchange="$(this).closest('form').submit();" style="padding-right: 0px;">
					<?foreach($arSizes as $size => $sizeText):?>
						<?$selected = ($_REQUEST['count'] == $size)? 'selected="selected"' : '';?>
						<option value="<?=$size?>" <?=$selected?>><?=$sizeText?></option>
					<?endforeach;?>
				</select>
			</div>
		</form>


	
	
	
	<?
}
?>





<?
if ($_GET['excel'] != 'y')
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php");
?>