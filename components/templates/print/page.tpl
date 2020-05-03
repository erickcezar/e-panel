<!DOCTYPE html>
<html{if $Page->GetPageDirection() != null} dir="{$Page->GetPageDirection()}"{/if}>
    <head>
        <title>{$Captions->GetMessageString($Page->GetTitle())}</title>
        <meta http-equiv="content-type" content="text/html{if $Page->GetContentEncoding() != null}; charset={$Page->GetContentEncoding()}{/if}">
        <link rel="stylesheet" href="components/assets/css/print.css">
        <link rel="stylesheet" href="components/assets/css/user_print.css">
</head>
<body style="background-color:white" id="print-{$Page->GetPageId()}">
    <h2>{$Captions->GetMessageString('ReportTitle')} {$Captions->GetMessageString($Page->GetTitle())}</h2>
    {$Grid}
<div class="footer_report">epanel</div>
</body>
</html>
