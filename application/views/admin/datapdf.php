<style type="text/css">
	body { 
	    font-family: serif; 
	    font-size: 8pt; 
	}
	table tr td {margin:0px;}
	.half{
		width: 50%;
	}
	.border-top{
		border-top-style:solid;border-top-width:1px;
	}
	.border-right{
		border-right-style:solid;border-right-width:1px;
	}
	.border-bottom{
		border-bottom-style:solid;border-bottom-width:1px;
	}
	.border-left{
		border-left-style:solid;border-left-width:1px;
	}
	.borderAll td,.borderAll th{
		border-style:solid;border-width:1px;
	}
	.borderBottom td,.borderBottom th{
		border-bottom-style:solid;border-bottom-width:1px;
		padding:4px;
	}
	.srNo{
		width: 10%;
		text-align:center;
		
	}
	.desc{
			width: 40%;
  	}
  	.qut{
			width: 20%;
  	}
  	.unit{
			width: 10%;
  	}
  	.rate{
			width: 15%;
  	}
  	.amt{
			width: 15%;
  	}
  	.text-center{
  		text-align: center;
  	}
	.text-left{
  		text-align: left;
  	}
  	.text-right{
  		text-align: right;
  	}
  	.items tr {

  	}
</style>
<table width="100%" style="border:1px solid black;">
	<tbady>
		<tr>
			<?php foreach ($headerList as $key => $value) { ?>
				<td class="border-right border-bottom">
					<strong><?php echo $value;?></strong>
				</td>
			<?php } ?>
		</tr>
		<?php foreach ($list as $key => $value) { ?>
			<tr>
				<?php foreach ($value as $key => $value1) { ?>
					<td class="border-right border-bottom">
						<strong><?php echo $value1;?></strong>
					</td>
					<?php } ?>
			</tr>
			<?php } ?>
	</tbady>
</table>