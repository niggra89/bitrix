<? namespace Bitrix\Main\UpdateSystem;$GLOBALS['____1045547907']= array(base64_decode(''.'Y'.'m'.'FzZTY0X2RlY29kZQ=='),base64_decode('dW5zZXJpY'.'Wxp'.'emU='),base64_decode('b3BlbnN'.'zbF92ZXJpZnk='),base64_decode('dW5zZXJpYWxpemU='));if(!function_exists(__NAMESPACE__.'\\___41509361')){function ___41509361($_396612723){static $_1086760019= false; if($_1086760019 == false) $_1086760019=array(''.'Y'.'W'.'x'.'sb'.'3d'.'l'.'ZF9jbGF'.'zc2Vz','aW5mbw==','c2lnbm'.'F'.'0dXJl','c2hhM'.'jU2V2l0'.'aFJTQ'.'UVuY3J5'.'cHR'.'pb24=',''.'aW5'.'mbw==','YWxsb3'.'dlZ'.'F9jbG'.'F'.'zc2Vz','RXJyb3'.'I'.'gd'.'mVyaWZ5IG9wZW5zc2'.'wg'.'W0hDUFA'.'wMV0=','LS'.'0tLS1CRUdJTiBQVUJMS'.'UMgS'.'0'.'VZ'.'LS0tLS0K'.'TUl'.'JQkl'.'qQU5CZ2tx'.'a'.'Gt'.'p'.'Rzl3MEJBUUVG'.'QUFP'.'Q0FRO'.'E'.'FN'.'SUlCQ'.'2'.'dL'.'Q'.'0FRRU'.'E2aGN4SXFp'.'aXRVWl'.'JNd1lp'.'dWtTVQpoOXh'.'hNW'.'ZFRFlsY'.'2'.'NiVzN2'.'ajh'.'Bd'.'mEzNXZLcV'.'ZONG'.'lCOXRxQ1g'.'3alU4NnFBYTJ2Mz'.'dtYlRGN'.'nBjWTZIR'.'1BB'.'aF'.'JGCmJwbn'.'d'.'YT1'.'k3WUd'.'4Q'.'jFuU0tadkUr'.'akFSYmlMTEJn'.'W'.'jFjRz'.'ZaMG'.'R1'.'dTVpMVhocElSTDFjTjB'.'IaDVm'.'ZXpw'.'alhDNk8KWXhZ'.'cTBuV'.'G9IV'.'Gp'.'5UmIxe'.'WN6d3RtaVJ3WXF1Z'.'F'.'hnL3hXeHB'.'wcXdGM'.'H'.'RVbGQ'.'zUUJ'.'yM'.'2'.'k2OEI4'.'anF'.'N'.'bStUamRlQQp1'.'L'.'2ZnM'.'Uow'.'Skd0Uj'.'Q'.'veks0'.'RzdZSk52aG11a'.'HJ'.'SR2t'.'5'.'QVFWMFRWdT'.'VMRXVnU3hqQX'.'BSbUlKUU5IUU1LM'.'EV'.'oOT'.'N3Ck1ab0ZvUH'.'A5U2'.'dKN'.'0dhRlU4a3pTK0VRY25'.'0W'.'Xh'.'iM'.'U5I'.'VUpVSXZUZGl1UlV'.'lRktse'.'V'.'Rke'.'Ely'.'S'.'DZ'.'DTC'.'8vYXBNSDMKRndJREFRQUIK'.'LS0'.'tLS'.'1FTkQgUF'.'VCT'.'E'.'lD'.'IEtFW'.'S0t'.'LS0'.'t');return base64_decode($_1086760019[$_396612723]);}}; use Bitrix\Main\Application; use Bitrix\Main\Security\Cipher; use Bitrix\Main\Security\SecurityException; class HashCodeParser{ private string $_1240978139; public function __construct(string $_1240978139){ $this->_1240978139= $_1240978139;}  public function parse(){ $_991279457= $GLOBALS['____1045547907'][0]($this->_1240978139); $_991279457= $GLOBALS['____1045547907'][1]($_991279457,[___41509361(0) => false]); if($GLOBALS['____1045547907'][2]($_991279457[___41509361(1)], $_991279457[___41509361(2)], $this->__506730410(), ___41509361(3)) == round(0+1)){ $_622245146= Application::getInstance()->getLicense()->getHashLicenseKey(); $_134027083= new Cipher(); $_1697433632= $_134027083->decrypt($_991279457[___41509361(4)], $_622245146); return $GLOBALS['____1045547907'][3]($_1697433632,[___41509361(5) => false]);} throw new SecurityException(___41509361(6));} private function __506730410(): string{ return ___41509361(7);}}?>