<div style="
    border: solid 1px #ddd;
    margin-bottom: 10px;
">
			<p style="
    margin-top: 5px;
    margin-left: 5px;
    font-weight: bold;
">退货/换货原因</p>
<hr>
					
<form method="post" action="index.php?controller=AdminOrders&amp;token={$smarty.get.token|escape:'html':'UTF-8'}&amp;vieworder&amp;id_order={$order->id}">

{if !$comreturnhistory}
<table style="   margin: 0 auto;">
	<tbody>
		<tr>
			<td>退货/换货原因:</td>
			<td style=" padding-left: 100px;">
				<select name="comreturn_reason">
				<option value="0"></option>
				<option value="1">在发货前要求退款</option>
				<option value="2">发货太慢（即订单处理太慢）</option>
				<option value="3">物流时间过长</option>
				<option value="4">丢单</option>
				<option value="5">错发</option>
				<option value="6">漏发</option>
				<option value="7">拒付</option>
				<option value="100">其他原因</option>
				</select>
			</td>
		</tr>
			
		<tr>
			<td>退货/换货备注:</td>
			<td style=" padding-left: 100px;"><textarea name="comreturn_comment" style="width:200px;height:50px;"></textarea></td>
		</tr>
			
		<tr>
			<td>退款方式:</td>
			<td style=" padding-left: 100px;"><input type="radio" name="comreturn_refund" value="现金">现金&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="comreturn_refund" value="CREDIT">CREDIT</td>
		</tr>
		
		<tr>
			<td>金额:$</td>
			<td style=" padding-left: 100px;"><input type="text" name="comreturn_sum" size="6" value="89.90"></td>
        </tr>
		
		<tr>
			<td>货品是否退回:</td>
			<td style=" padding-left: 100px;"><input type="radio" name="comreturn_return" margin-left:100px="" 			value="退回">退回&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="comreturn_return" margin-left:100px="" value="赠送客户">赠送客户</td>
		</tr>
		
		<tr>
			<td colspan="2" style=" padding-left: 330px">
					<button type="submit" onclick="if(confirm('你确定提交退换货/原因？')){}else{ return  false; }" class="btn btn-default" name="submitmyReturn">
									<i class="icon-ok"></i>
									确认
								</button>
			</td>
		</tr>
		
	</tbody>
</table>
{else}
<table style="   margin: 0 auto;">
	<tbody>
		<tr>
			<td>退货/换货原因:</td>
			<td style=" padding-left: 100px;">
				<select name="comreturn_reason">
				{if $comreturnhistory['comreturn_reason']==0}
				<option value="0" selected=""></option>
				{else}
				<option value="0"></option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==1}
				<option value="1" selected="">在发货前要求退款</option>
				{else}
				<option value="1">在发货前要求退款</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==2}
				<option value="2" selected="">发货太慢（即订单处理太慢）</option>
				{else}
				<option value="2" >发货太慢（即订单处理太慢）</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==3}
				<option value="3" selected="">物流时间过长</option>
								{else}
								<option value="3" >物流时间过长</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==4}
				<option value="4" selected="">丢单</option>
								{else}
								<option value="4" >丢单</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==5}
				<option value="5" selected="">错发</option>
								{else}
								<option value="5" >错发</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==6}
				<option value="6" selected="" >漏发</option>
								{else}
									<option value="6">漏发</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==7}
				<option value="7" selected="" >拒付</option>
								{else}
							<option value="7"  >拒付</option>
				{/if}
				{if $comreturnhistory['comreturn_reason']==100}
				<option value="100" selected="" >其他原因</option>
								{else}
								<option value="100"  >其他原因</option>
				{/if}
				</select>
			</td>
		</tr>
			
		<tr>
			<td>退货/换货备注:</td>
			<td style=" padding-left: 100px;">
			
			<textarea name="comreturn_comment" style="width:200px;height:50px;">
			{$comreturnhistory['comreturn_comment']}
			</textarea>
			
			</td>
		</tr>
		
		<tr>
			<td>退款方式:</td>
			<td style=" padding-left: 100px;">
			   {if $comreturnhistory['comreturn_refund']=='现金'}
				<input type="radio" name="comreturn_refund" value="现金" checked="checked">
			   {else}
			   <input type="radio" name="comreturn_refund" value="现金">
			   {/if}
				现金&nbsp;&nbsp;&nbsp;&nbsp;
               {if $comreturnhistory['comreturn_refund']=='CREDIT'}
			   <input type="radio" name="comreturn_refund" value="CREDIT" checked="checked">
			   {else}
			   <input type="radio" name="comreturn_refund" value="CREDIT" >
			   {/if}
			   
			   
			   CREDIT
			</td>
		</tr>
		
		<tr>
			<td>金额:$</td>
			<td style=" padding-left: 100px;"><input type="text" name="comreturn_sum" size="6" value="{$comreturnhistory['comreturn_sum']}">
			</td>
        </tr>
		
		<tr>
			<td>货品是否退回:</td>
			<td style=" padding-left: 100px;">
			{if $comreturnhistory['comreturn_return']=='退回'}
			<input type="radio" name="comreturn_return" margin-left:100px="" value="退回" checked="checked">
			{else}
			<input type="radio" name="comreturn_return" margin-left:100px="" value="退回" >
			{/if}
			
			退回&nbsp;&nbsp;&nbsp;&nbsp;
			
				{if $comreturnhistory['comreturn_return']=='赠送客户'}
            <input type="radio" name="comreturn_return" margin-left:100px="" value="赠送客户" checked="checked">
			{else}
			<input type="radio" name="comreturn_return" margin-left:100px="" value="赠送客户">
			{/if}
			赠送客户
			</td>
		</tr>
		
		<tr>
			<td colspan="2" style=" padding-left: 330px">
					<button type="submit" onclick="if(confirm('你确定提交退换货/原因？')){}else{ return  false; }" class="btn btn-default" name="submitmyReturn">
									<i class="icon-ok"></i>
									确认
								</button>
			</td>
		</tr>
		
	</tbody>
</table>
{/if}


</form>
			
				
</div>
				
	{if isset($comreturnactor)&&$comreturnactor }				
				
<div style="
    border: solid 1px #ddd;
    margin-bottom: 10px;
">
			<p style="
    margin-top: 5px;
    margin-left: 5px;
    font-weight: bold;
">退货/换货操作记录</p>
<hr>
					<table style="
    margin: 0 auto;
">
					<thead style="
    border-bottom: 1px solid gray;
    padding-bottom: 10px;
">
		<tr>
		<td style=" width:550px;padding: 10px;">操作记录</td>
		<td style=" width:180px;padding: 10px;">时间</td>
		</tr>
		</thead>
		<tbody>
	
		{foreach from=$comreturnactor item=remind_history name=remind_history}
		{if $smarty.foreach.remind_history.first}
		<tr style="background-color: rgba(14, 247, 75, 0.17);color:black;">
		<td style="padding: 5px;">{$remind_history['action']}</td>
		<td style="padding: 5px;">{$remind_history['operate_time']}</td>
		</tr>
		{else}
		<tr>
		<td style="padding: 5px;">{$remind_history['action']}</td>
		<td style="padding: 5px;">{$remind_history['operate_time']}</td>
		</tr>
		{/if}
		{/foreach}	
		
		</tbody>	
		</table>
</div>
{/if}