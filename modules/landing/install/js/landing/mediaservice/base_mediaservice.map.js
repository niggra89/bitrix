{"version":3,"file":"base_mediaservice.map.js","names":["BX","namespace","isArray","Landing","Utils","MediaService","BaseMediaService","url","settings","TypeError","this","encodeURI","matcher","RegExp","embedURL","idPlace","type","params","isDataLoaded","isBgVideoMode","isVertical","prototype","getMediaId","match","getUserSettings","result","form","getSettingsForm","fields","fetchValues","Object","keys","forEach","key","encodeURIComponent","join","getSettings","util","objectMerge","clone","getQueryParams","getEmbedURL","matchedUrl","slice","call","value","index","replace","add_url_param","getEmbedPreview","previewURL","getEmbedElement","create","attrs","src","frameborder","gesture","allow","allowfullscreen","getURLPreview","getURLPreviewElement","then","preview","description","DESCRIPTION","title","TITLE","length","props","className","children","style","IMAGE","text","bind","setBgVideoMode"],"sources":["base_mediaservice.js"],"mappings":"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"}