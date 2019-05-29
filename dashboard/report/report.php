<div class="row">
     <div class="col-lg-12">
             <h1 class="page-header"><i class="fa fa-bar-chart fa-fw"></i> <?php echo @LA_MN_HOME;?></h1>
     </div>        
</div>
<ol class="breadcrumb">
  <li><a href="index.php"><?php echo @LA_MN_HOME;?></a></li>
  <li class="active">รายงาน</li>
</ol>

<style>
@media print {
    .no-print {
        display: none;
    }
}
</style>

<script language="javascript"> 
function printPage(printContent) { 
var display_setting="toolbar=yes,menubar=yes,"; 
display_setting+="scrollbars=yes,width=650, height=600, left=100, top=25"; 
var printpage=window.open("","",display_setting); 
printpage.document.open(); 
printpage.document.write('<html><head><title>Print Page</title></head>'); 
printpage.document.write('<body onLoad="self.print()" align="center">'+ printContent +'</body></html>'); 
printpage.document.close(); 
printpage.focus(); 
} 
</script>

<a href="javascript:void(0);" onClick="printPage(printsection.innerHTML)">Print Preview</a>


<div id="printsection"> 
<table width="652" border="0"> 
<tr> 
<td width="30" height="24">&nbsp;</td> 
<td width="606"><strong>This is a sample content for printing</strong></td> 
</tr> 
<tr> 
<td height="129">&nbsp;</td> 
<td>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like.</td> 
</tr> 
</table> 
</div>


<body style="margin: 1in">
<a class="print_btn no-print" href="" onclick="window.print();">Print</a>
    <body>
