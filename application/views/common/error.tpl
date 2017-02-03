<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>操作错误 - 百动网管理平台</title>
<link href="{staticurl action="admin/wrap.css" type="css"}" type="text/css" rel="stylesheet" />
<link href="{staticurl action="admin/common.css" type="css"}" type="text/css" rel="stylesheet" />
</head>

<body>
<div class="pwis">
<div class="error ">
<div class="x" style="display:none"></div>
<h4>操作提示</h4>
<div class="msg_box">
<p class="msg_title">{$msg}</p>
<p><a href="{if $url == ''}javascript:history.go(-1){else}{$url}{/if}" style="color:#4f6b72; text-decoration:none">正在跳转,请稍后...</a></p>

</div>



 
</div>
{if $url == ''}
		<script language="javascript">setTimeout('history.go(-1)', {$delay});</script>
        {else}
        <script language="javascript">setTimeout('window.location.href="{$url}"', {$delay});</script>
        {/if}
        
</body>
</html>

		
 