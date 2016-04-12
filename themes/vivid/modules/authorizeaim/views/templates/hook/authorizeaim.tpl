{*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2013 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<link rel="shortcut icon" type="image/x-icon" href="{$module_dir}img/secure.png" />
{if $isFailed == 1}		
<p style="color: red;">			
	{if !empty($smarty.get.message)}
		{l s='Error detail from AuthorizeAIM : ' mod='authorizeaim'}
		{$smarty.get.message|htmlentities}
	{else}	
		{l s='Error, please verify the card information' mod='authorizeaim'}
	{/if}
</p>
{/if}
{literal}
<style>
	#authorizeaim_form .form-control{max-width:350px;}
	#authorizeaim_form .col-sm-6{max-width:175px}
	@media (min-width: 768px){
		.authorizeaim_form_span{border: 1px solid #595A5E;display: block;padding: 1.5em;text-decoration: none;}
	}
	@media (max-width: 468px){
		.authorizeaim_form_span{padding: 0.5em;text-decoration: none;border: 1px solid #595A5E;display: block;}
		#authorizeaim_form .uk-form-controls img{display: none}
	}
</style>
{/literal}
<form name="authorizeaim_form" id="authorizeaim_form" action="{$module_dir}validation.php" method="post">
	<span class="authorizeaim_form_span select_payment selected_click">
		<a id="click_authorizeaim" href="#" title="{l s='Pay with AuthorizeAIM' mod='authorizeaim'}">
		{if $cards.visa == 1}<img src="{$module_dir}cards/visa.gif" alt="{l s='Visa Logo' mod='authorizeaim'}" style="vertical-align: middle;" />{/if}
		{if $cards.mastercard == 1}<img src="{$module_dir}cards/mastercard.gif" alt="{l s='Mastercard Logo' mod='authorizeaim'}" style="vertical-align: middle;" />{/if}
		{if $cards.discover == 1}<img src="{$module_dir}cards/discover.gif" alt="{l s='Discover Logo' mod='authorizeaim'}" style="vertical-align: middle;" />{/if}
		{if $cards.ax == 1}<img src="{$module_dir}cards/ax.gif" alt="{l s='American Express Logo' mod='authorizeaim'}" style="vertical-align: middle;" />{/if}
		<img src="{$module_dir}logoa.gif" alt="secure payment" width="100"/>
		&nbsp;&nbsp;{l s='Secured card payment' mod='authorizeaim'}			
		</a>
		<div class="card-wrapper"></div>
		
		{if $isFailed == 0}						
			<div id="aut2">				
			{else}						
			<div id="aut2">				
				{/if}				
				<div class="uk-form-row">
					<label class="uk-form-label">
						{l s='Card number' mod='authorizeaim'}
					</label>
					<div class="uk-form-controls">
						<input type="text" name="x_card_num" id="cardnum" class="form-control uk-form-large" size="30" maxlength="24" autocomplete="Off" placeholder="**** **** **** ****"/>
						<img src="{$module_dir}secure.png" alt="" />
					</div>
				</div>
				<div class="uk-form-row">
					<input type="hidden" name="x_solution_ID" value="A1000006" />
					<input type="hidden" name="x_invoice_num" value="{$x_invoice_num}" />

					<label class="uk-form-label">{l s='Full name' mod='authorizeaim'}</label>
					<div class="uk-form-controls">
						<input type="text" name="name" id="fullname" class="form-control uk-form-large"/><img src="{$module_dir}secure.png" alt="" />
					</div>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label">{l s='Card Type' mod='authorizeaim'}</label>
					<div class="uk-form-controls">
						<select id="cardType" class="form-control not_uniform uk-form-large">
							{if $cards.ax == 1}<option value="AmEx">American Express</option>{/if}
							{if $cards.visa == 1}<option value="Visa">Visa</option>{/if}
							{if $cards.mastercard == 1}<option value="MasterCard">MasterCard</option>{/if}
							{if $cards.discover == 1}<option value="Discover">Discover</option>{/if}
						</select>
						<img src="{$module_dir}secure.png" alt="" />
					</div>
				</div>
				
				<div class="uk-form-row">
					<label class="uk-form-label">
						{l s='Expiration date' mod='authorizeaim'}
					</label>
					<div class="uk-form-controls">
						<div class="row">
							<div class="col-sm-6 col-xs-6">
							<select id="x_exp_date_m" name="x_exp_date_m" class="form-control not_uniform uk-form-large">{section name=date_m start=01 loop=13}
								<option value="{$smarty.section.date_m.index}">{$smarty.section.date_m.index}</option>{/section}
							</select>
							</div>
							<div class="col-sm-6 col-xs-6">
							<select name="x_exp_date_y" class="form-control not_uniform uk-form-large">{section name=date_y start=14 loop=32}
								<option value="{$smarty.section.date_y.index}">20{$smarty.section.date_y.index}</option>{/section}
							</select>
							</div>
							<img src="{$module_dir}secure.png" alt=""/>
						</div>
					</div>
				</div>
				<div class="uk-form-row">
					<label class="uk-form-label">{l s='CVV' mod='authorizeaim'}</label>
					<div class="uk-form-controls">
						<input type="text" name="x_card_code" id="x_card_code" class="form-control uk-form-large" placeholder="****"/>
						<img src="{$module_dir}secure.png" alt=""/>
						<div class="text-info">{l s='the 3 last digits on the back of your credit card' mod='authorizeaim'}</div>
						<img src="{$module_dir}cvv.png" id="cvv_help_img" alt="" style="display: none;margin-left: 211px;" />
						<div id="cart">
							<input type="button" id="asubmit" value="{l s='Validate order' mod='authorizeaim'}" class="uk-button uk-button-primary uk-margin-top" />
						</div>
					</div>
				</div>		
			</div>		
	</span>	
</form>

<script src="/themes/uniwigs2016/js/card.min.js"></script>

<script>
  var card = new Card({
    form: '#authorizeaim_form',
    container: '.card-wrapper',
});
    
</script>

<script type="text/javascript">
	var mess_error = "{l s='Please check your credit card information (Credit card type, number and expiration date)' mod='authorizeaim' js=1}";
	var mess_error2 = "{l s='Please specify your Full Name' mod='authorizeaim' js=1}";
	{literal}		$(document).ready(function() {
		$('#x_exp_date_m').children('option').each(function() {
			if ($(this).val() < 10) {
				$(this).val('0' + $(this).val());
				$(this).html($(this).val())
			}
		});
		$('#click_authorizeaim').click(function(e) {
			e.preventDefault();
			$('#click_authorizeaim').fadeOut("fast", function() {
				$("#aut2,.card-wrapper").show();
				$('#click_authorizeaim').fadeIn('fast');
			});
			$('#click_authorizeaim').unbind();
			$('#click_authorizeaim').click(function(e) {
				e.preventDefault();
			});
		});
		$('#cvv_help').click(function() {
			$("#cvv_help_img").show();
			$('#cvv_help').unbind();
		});
		$('#asubmit').click(function() {
			if ($('#fullname').val() == '') {
				alert(mess_error2);
			} else if (!validateCC($('#cardnum').val(), $('#cardType').val()) || $('#x_card_code').val() == '') {
				alert(mess_error);
			} else {
				$('#authorizeaim_form').submit();
				$('#asubmit').prop("disabled", true);
			}
			return false;
		});
	});{/literal}</script>
