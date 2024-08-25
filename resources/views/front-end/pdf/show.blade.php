<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $file->real_name }}</title>
</head>
<body style="margin: 0px;">
	<embed type="application/pdf" 
		   src="{{ url($file->path) }}" 
		   width="100%" 
		   height="718px" 
		   alt="pdf" 
		   pluginspage="http://www.adobe.com/products/acrobat/readstep2.html" 
		   background-color="0xFF525659" 
		   top-toolbar-height="0" 
		   full-frame=""  
		   title="CHROME"
	>
</body>
</html>



