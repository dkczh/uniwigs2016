<div id="opc_new_account" class="opc-main-block">
	<div id="opc_new_account-overlay" class="opc-overlay" style="display: none;"></div>
	<h1 class="page-heading step-num"><span>1</span> {l s='Account'}</h1>
	<form action="{$link->getPageLink('authentication', true, NULL, "back=order-opc")|escape:'html':'UTF-8'}" method="post" id="login_form" class="box uk-form uk-form-horizontal">
		<fieldset>
			<h3 class="page-subheading">{l s='Already registered?'}</h3>
			<p><a href="{$link->getPageLink('authentication', true)|escape:'html':'UTF-8'}" id="openLoginFormBlock" class="uk-button uk-button-small">&raquo; {l s='Click here'}</a></p>
			<div id="login_form_content" style="display:none;">
				<!-- Error return block -->
				<div id="opc_login_errors" class="alert alert-danger" style="display:none;"></div>
				<!-- END Error return block -->
				<div class="form-group uk-form-row">
					<label for="login_email" class="uk-form-label">{l s='Email address'}</label>
					<div class="uk-form-controls">
						<input type="email" class="form-control validate" id="login_email" name="email" data-validate="isEmail" />
					</div>
				</div>
				<div class="form-group uk-form-row">
					<label for="login_passwd" class="uk-form-label">{l s='Password'}</label>
					<div class="uk-form-controls">
						<input class="form-control validate" type="password" id="login_passwd" name="login_passwd" data-validate="isPasswd" />
					</div>
				</div>
				<a href="{$link->getPageLink('password', true)|escape:'html':'UTF-8'}" class="lost_password">{l s='Forgot your password?'}</a>
				<div class="submit">
					{if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'html':'UTF-8'}" />{/if}
					<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium"><span><i class="icon-lock left"></i>{l s='Sign in'}</span></button>
				</div>
			</div>
		</fieldset>
	</form>
	<form action="{$link->getPageLink('authentication', true)|escape:'html':'UTF-8'}" method="post" id="new_account_form" class="std uk-form uk-form-horizontal" autocomplete="on" autofill="on">
		<fieldset>
			<div class="box">
				<h3 id="new_account_title" class="page-subheading">{l s='New Customer'}</h3>
				<div id="opc_account_choice" class="row">
					<div class="col-xs-12 col-md-6">
						<p class="title_block">{l s='Instant Checkout'}</p>
						<p class="opc-button">
							<button type="submit" class="btn btn-default button button-medium exclusive" id="opc_guestCheckout"><span>{l s='Guest checkout'}</span></button>
						</p>
					</div>
					<div class="col-xs-12 col-md-6">
						<p class="title_block">{l s='Create your account today and enjoy:'}</p>
						<ul class="bullet">
							<li>- {l s='Personalized and secure access'}</li>
							<li>- {l s='A fast and easy check out process'}</li>
							<li>- {l s='Separate billing and shipping addresses'}</li>
						</ul>
						<p class="opc-button">
							<button type="submit" class="btn btn-default button button-medium exclusive" id="opc_createAccount"><span><i class="icon-user left"></i>{l s='Create an account'}</span></button>
						</p>
					</div>
				</div>
				<div id="opc_account_form" class="unvisible">
					{$HOOK_CREATE_ACCOUNT_TOP}
					<!-- Error return block -->
					<div id="opc_account_errors" class="alert alert-danger uk-alert uk-alert-danger" data-uk-alert style="display:none;"></div>
					<!-- END Error return block -->
					<!-- Account -->
					<input type="hidden" id="is_new_customer" name="is_new_customer" value="0" />
					<input type="hidden" id="opc_id_customer" name="opc_id_customer" value="{if isset($guestInformations) && isset($guestInformations.id_customer) && $guestInformations.id_customer}{$guestInformations.id_customer}{else}0{/if}" />
					<input type="hidden" id="opc_id_address_delivery" name="opc_id_address_delivery" value="{if isset($guestInformations) && isset($guestInformations.id_address_delivery) && $guestInformations.id_address_delivery}{$guestInformations.id_address_delivery}{else}0{/if}" />
					<input type="hidden" id="opc_id_address_invoice" name="opc_id_address_invoice" value="{if isset($guestInformations) && isset($guestInformations.id_address_delivery) && $guestInformations.id_address_delivery}{$guestInformations.id_address_delivery}{else}0{/if}" />
					<p class="required"><sup>*</sup>{l s='Required field'}</p>
					<div class="required text form-group uk-form-row">
						<label for="email" class="uk-form-label">{l s='Email'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="email" class="text form-control validate" id="email" name="email" data-validate="isEmail" value="{if isset($guestInformations) && isset($guestInformations.email) && $guestInformations.email}{$guestInformations.email}{/if}" />
						</div>
					</div>
					<div class="required password is_customer_param form-group uk-form-row">
						<label for="passwd" class="uk-form-label">{l s='Password'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="password" class="text form-control validate" name="passwd" id="passwd" data-validate="isPasswd" />
							<span class="form_info">{l s='(five characters min.)'}</span>
						</div>
					</div>
					<div class="required clearfix gender-line uk-form-row">
						<label class="uk-form-label">{l s='Social title'}</label>
						<div class="uk-form-controls">
							{foreach from=$genders key=k item=gender}
							<div class="radio-inline">
								<label for="id_gender{$gender->id_gender}" class="top">
								<input type="radio" name="id_gender" id="id_gender{$gender->id_gender}" value="{$gender->id_gender}"{if isset($smarty.post.id_gender) && $smarty.post.id_gender == $gender->id_gender || (isset($guestInformations) && $guestInformations.id_gender == $gender->id_gender)} checked="checked"{/if} />
									{$gender->name}</label>
							</div>
							{/foreach}
						</div>
					</div>
					<div class="required form-group uk-form-row">
						<label for="firstname" class="uk-form-label">{l s='First name'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" id="customer_firstname" name="customer_firstname" onblur="$('#firstname').val($(this).val());" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.customer_firstname) && $guestInformations.customer_firstname}{$guestInformations.customer_firstname}{/if}" />
						</div>
					</div>
					<div class="required form-group uk-form-row">
						<label for="lastname" class="uk-form-label">{l s='Last name'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="form-control validate" id="customer_lastname" name="customer_lastname" onblur="$('#lastname').val($(this).val());" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.customer_lastname) && $guestInformations.customer_lastname}{$guestInformations.customer_lastname}{/if}" />
						</div>
					</div>
					<div class="select form-group date-select uk-form-row">
						<label class="uk-form-label">{l s='Date of Birth'}</label>
						<div class="row uk-form-controls">
							<div class="col-xs-4">
								<select id="days" name="days" class="form-control">
									<option value="">--</option>
									{foreach from=$days item=day}
									<option value="{$day|escape:'html':'UTF-8'}" {if isset($guestInformations) && isset($guestInformations.sl_day) && ($guestInformations.sl_day == $day)} selected="selected"{/if}>{$day|escape:'html':'UTF-8'}&nbsp;&nbsp;</option>
									{/foreach}
								</select>
								{*
								{l s='January'}
								{l s='February'}
								{l s='March'}
								{l s='April'}
								{l s='May'}
								{l s='June'}
								{l s='July'}
								{l s='August'}
								{l s='September'}
								{l s='October'}
								{l s='November'}
								{l s='December'}
								*}
							</div>
							<div class="col-xs-4">
								<select id="months" name="months" class="form-control">
									<option value="">--</option>
									{foreach from=$months key=k item=month}
									<option value="{$k|escape:'html':'UTF-8'}" {if isset($guestInformations) && isset($guestInformations.sl_month) && ($guestInformations.sl_month == $k)} selected="selected"{/if}>{l s=$month}&nbsp;</option>
									{/foreach}
								</select>
							</div>
							<div class="col-xs-4">
								<select id="years" name="years" class="form-control">
									<option value="">--</option>
									{foreach from=$years item=year}
									<option value="{$year|escape:'html':'UTF-8'}" {if isset($guestInformations) && isset($guestInformations.sl_year) && ($guestInformations.sl_year == $year)} selected="selected"{/if}>{$year|escape:'html':'UTF-8'}&nbsp;&nbsp;</option>
									{/foreach}
								</select>
							</div>
						</div>
					</div>
					<h3 class="page-subheading top-indent">{l s='Delivery address'}</h3>
					{$stateExist = false}
					{$postCodeExist = false}
					{$dniExist = false}
					{foreach from=$dlv_all_fields item=field_name}
					{if $field_name eq "company"}
						<div class="text form-group uk-form-row">
							<label for="company" class="uk-form-label">{l s='Company'}{if in_array($field_name, $required_fields)} <sup>*</sup>{/if}</label>
							<div class="uk-form-controls">
								<input type="text" class="text form-control validate" id="company" name="company" data-validate="isGenericName" value="{if isset($guestInformations) && isset($guestInformations.company) && $guestInformations.company}{$guestInformations.company}{/if}" />
							</div>
						</div>
					{elseif $field_name eq "vat_number"}
					<div id="vat_number_block" style="display:none;">
						<div class="form-group uk-form-row">
							<label for="vat_number" class="uk-form-label">{l s='VAT number'}{if in_array($field_name, $required_fields)} <sup>*</sup>{/if}</label>
							<div class="uk-form-controls">
								<input type="text" class="text form-control" name="vat_number" id="vat_number" value="{if isset($guestInformations) && isset($guestInformations.vat_number) && $guestInformations.vat_number}{$guestInformations.vat_number}{/if}" />
							</div>
						</div>
					</div>
					{elseif $field_name eq "dni"}
					{assign var='dniExist' value=true}
					<div class="required dni form-group uk-form-row">
						<label for="dni" class="uk-form-label">{l s='Identification number'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="dni" id="dni" data-validate="isDniLite" value="{if isset($guestInformations) && isset($guestInformations.dni) && $guestInformations.dni}{$guestInformations.dni}{/if}" />
							<span class="form_info">{l s='DNI / NIF / NIE'}</span>
						</div>
					</div>
					{elseif $field_name eq "firstname"}
					<div class="required text form-group uk-form-row">
						<label for="firstname" class="uk-form-label">{l s='First name'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" id="firstname" name="firstname" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.firstname) && $guestInformations.firstname}{$guestInformations.firstname}{/if}" />
						</div>
					</div>
					{elseif $field_name eq "lastname"}
					<div class="required text form-group uk-form-row">
						<label for="lastname" class="uk-form-label">{l s='Last name'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" id="lastname" name="lastname" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.lastname) && $guestInformations.lastname}{$guestInformations.lastname}{/if}" />
						</div>
					</div>
					{elseif $field_name eq "address1"}
					<div class="required text form-group uk-form-row">
						<label for="address1" class="uk-form-label">{l s='Address'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="address1" id="address1" data-validate="isAddress" value="{if isset($guestInformations) && isset($guestInformations.address1) && isset($guestInformations) && isset($guestInformations.address1) && $guestInformations.address1}{$guestInformations.address1}{/if}" placeholder="PO BOX cannot be delivered"/>
							<p class="text-info">Street address,company name,c/o</p>
						</div>
					</div>
					{elseif $field_name eq "address2"}
					<div class="text{if !in_array($field_name, $required_fields)} is_customer_param{/if} form-group uk-form-row">
						<label for="address2" class="uk-form-label">{l s='Address (Line 2)'}{if in_array($field_name, $required_fields)} <sup>*</sup>{/if}</label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="address2" id="address2" data-validate="isAddress" value="{if isset($guestInformations) && isset($guestInformations.address2) && isset($guestInformations) && isset($guestInformations.address2) && $guestInformations.address2}{$guestInformations.address2}{/if}" />
							<p class="text-info">Apartment,suite,unit,building,floor,etc.</p>
						</div>
					</div>
					{elseif $field_name eq "postcode"}
					{$postCodeExist = true}
					<div class="required postcode text form-group uk-form-row">
						<label for="postcode" class="uk-form-label">{l s='Zip/Postal code'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="postcode" id="postcode" data-validate="isPostCode" value="{if isset($guestInformations) && isset($guestInformations.postcode) && $guestInformations.postcode}{$guestInformations.postcode}{/if}"/>
						</div>
					</div>
					{elseif $field_name eq "city"}
					<div class="required text form-group uk-form-row">
						<label for="city" class="uk-form-label">{l s='City'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="city" id="city" data-validate="isCityName" value="{if isset($guestInformations) && isset($guestInformations.city) && $guestInformations.city}{$guestInformations.city}{/if}" />
						</div>
					</div>
					{elseif $field_name eq "country" || $field_name eq "Country:name"}
					<div class="required select form-group uk-form-row">
						<label for="id_country" class="uk-form-label">{l s='Country'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<select name="id_country" id="id_country" class="form-control">
								{foreach from=$countries item=v}
								<option value="{$v.id_country}"{if (isset($guestInformations) && isset($guestInformations.id_country) && $guestInformations.id_country == $v.id_country) || (!isset($guestInformations) && $sl_country == $v.id_country)} selected="selected"{/if}>{$v.name|escape:'html':'UTF-8'}</option>
								{/foreach}
							</select>
						</div>
					</div>
					{elseif $field_name eq "state" || $field_name eq 'State:name'}
					{$stateExist = true}
					<div class="required id_state form-group uk-form-row" style="display:none;">
						<label for="id_state" class="uk-form-label">{l s='State'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<select name="id_state" id="id_state" class="form-control">
								<option value="">-</option>
							</select>
						</div>
					</div>
					{/if}
					{/foreach}
					{if !$postCodeExist}
					<div class="required postcode form-group unvisible uk-form-row">
						<label for="postcode" class="uk-form-label">{l s='Zip/Postal code'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="postcode" id="postcode" data-validate="isPostCode" value="{if isset($guestInformations) && isset($guestInformations.postcode) && $guestInformations.postcode}{$guestInformations.postcode}{/if}"/>
						</div>
					</div>
					{/if}
					{if !$stateExist}
					<div class="required id_state form-group unvisible uk-form-row">
						<label for="id_state" class="uk-form-label">{l s='State'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<select name="id_state" id="id_state" class="form-control">
								<option value="">-</option>
							</select>
						</div>
					</div>
					{/if}
					{if !$dniExist}
					<div class="required dni form-group uk-form-row">
						<label for="dni" class="uk-form-label">{l s='Identification number'} <sup>*</sup></label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="dni" id="dni" data-validate="isDniLite" value="{if isset($guestInformations) && isset($guestInformations.dni) && $guestInformations.dni}{$guestInformations.dni}{/if}" />
							<span class="form_info">{l s='DNI / NIF / NIE'}</span>
						</div>
					</div>
					{/if}
					<div class="form-group is_customer_param uk-form-row">
						<label for="other" class="uk-form-label">{l s='Additional information'}</label>
						<div class="uk-form-controls">
							<textarea class="form-control" name="other" id="other" cols="26" rows="7"></textarea>
						</div>
					</div>
					<div class="form-group is_customer_param uk-form-row">
						<label for="phone" class="uk-form-label">{l s='Home phone'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="phone" id="phone" data-validate="isPhoneNumber" value="{if isset($guestInformations) && isset($guestInformations.phone) && $guestInformations.phone}{$guestInformations.phone}{/if}" />
						</div>
					</div>
					<div class="{if isset($one_phone_at_least) && $one_phone_at_least}required {/if}form-group uk-form-row">
						<label for="phone_mobile" class="uk-form-label">{l s='Mobile phone'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>**</sup>{/if}</label>
						<div class="uk-form-controls">
							<input type="text" class="text form-control validate" name="phone_mobile" id="phone_mobile" data-validate="isPhoneNumber" value="{if isset($guestInformations) && isset($guestInformations.phone_mobile) && $guestInformations.phone_mobile}{$guestInformations.phone_mobile}{/if}" />
						</div>
					</div>
					{if isset($one_phone_at_least) && $one_phone_at_least}
						{assign var="atLeastOneExists" value=true}
						<p class="inline-infos required">** {l s='You must register at least one phone number.'}</p>
					{/if}
					<input type="hidden" name="alias" id="alias" value="{l s='My address'}"/>

					<div class="checkbox uk-form-row">
						<label for="invoice_address">
						
							<input type="checkbox" name="invoice_address" id="invoice_address"{if (isset($smarty.post.invoice_address) && $smarty.post.invoice_address) || (isset($guestInformations) && isset($guestInformations.invoice_address) && $guestInformations.invoice_address)} checked="checked"{/if} autocomplete="off"/>
							{l s='Please use another address for invoice'}</label>
					</div>

					<div id="opc_invoice_address" class="is_customer_param">
						{assign var=stateExist value=false}
						{assign var=postCodeExist value=false}
						{assign var='dniExist' value=false}
						<h3 class="page-subheading top-indent">{l s='Invoice address'}</h3>
						{foreach from=$inv_all_fields item=field_name}
						{if $field_name eq "company"}
						<div class="form-group uk-form-row">
							<label for="company_invoice" class="uk-form-label">{l s='Company'}{if in_array($field_name, $required_fields)} <sup>*</sup>{/if}</label>
							<div class="uk-form-controls">
								<input type="text" class="text form-control validate" id="company_invoice" name="company_invoice" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.company_invoice) && $guestInformations.company_invoice}{$guestInformations.company_invoice}{/if}" />
							</div>
						</div>
						{elseif $field_name eq "vat_number"}
						<div id="vat_number_block_invoice" class="is_customer_param" style="display:none;">
							<div class="form-group uk-form-row">
								<label for="vat_number_invoice" class="uk-form-label">{l s='VAT number'}{if in_array($field_name, $required_fields)} <sup>*</sup>{/if}</label>
								<div class="uk-form-controls">
									<input type="text" class="form-control" id="vat_number_invoice" name="vat_number_invoice" value="{if isset($guestInformations) && isset($guestInformations.vat_number_invoice) && $guestInformations.vat_number_invoice}{$guestInformations.vat_number_invoice}{/if}" />
								</div>
							</div>
						</div>
						{elseif $field_name eq "dni"}
						{assign var='dniExist' value=true}
						<div class="required form-group dni_invoice uk-form-row">
							<label for="dni_invoice" class="uk-form-label">{l s='Identification number'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="text form-control validate" name="dni_invoice" id="dni_invoice" data-validate="isDniLite" value="{if isset($guestInformations) && isset($guestInformations.dni_invoice) && $guestInformations.dni_invoice}{$guestInformations.dni_invoice}{/if}" />
								<span class="form_info">{l s='DNI / NIF / NIE'}</span>
							</div>
						</div>
						{elseif $field_name eq "firstname"}
						<div class="required form-group uk-form-row">
							<label for="firstname_invoice" class="uk-form-label">{l s='First name'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" id="firstname_invoice" name="firstname_invoice" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.firstname_invoice) && $guestInformations.firstname_invoice}{$guestInformations.firstname_invoice}{/if}" />
							</div>
						</div>
						{elseif $field_name eq "lastname"}
						<div class="required form-group uk-form-row">
							<label for="lastname_invoice" class="uk-form-label">{l s='Last name'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" id="lastname_invoice" name="lastname_invoice" data-validate="isName" value="{if isset($guestInformations) && isset($guestInformations.lastname_invoice) && $guestInformations.lastname_invoice}{$guestInformations.lastname_invoice}{/if}" />
							</div>
						</div>
						{elseif $field_name eq "address1"}
						<div class="required form-group uk-form-row">
							<label for="address1_invoice" class="uk-form-label">{l s='Address'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" name="address1_invoice" id="address1_invoice" data-validate="isAddress" value="{if isset($guestInformations) && isset($guestInformations.address1_invoice) && isset($guestInformations) && isset($guestInformations.address1_invoice) && $guestInformations.address1_invoice}{$guestInformations.address1_invoice}{/if}" placeholder="PO BOX cannot be delivered"/>
								<p class="text-info">Street address,company name,c/o</p>
							</div>
						</div>
						{elseif $field_name eq "address2"}
						<div class="form-group{if !in_array($field_name, $required_fields)} is_customer_param{/if} uk-form-row">
							<label for="address2_invoice" class="uk-form-label">{l s='Address (Line 2)'}{if in_array($field_name, $required_fields)} <sup>*</sup>{/if}</label>
							<div class="uk-form-controls">
								<input type="text" class="form-control address" name="address2_invoice" id="address2_invoice" data-validate="isAddress" value="{if isset($guestInformations) && isset($guestInformations.address2_invoice) && isset($guestInformations) && isset($guestInformations.address2_invoice) && $guestInformations.address2_invoice}{$guestInformations.address2_invoice}{/if}" />
								<p class="text-info">Apartment,suite,unit,building,floor,etc.</p>
							</div>
						</div>
						{elseif $field_name eq "postcode"}
						{$postCodeExist = true}
						<div class="required postcode_invoice form-group uk-form-row">
							<label for="postcode_invoice" class="uk-form-label">{l s='Zip/Postal Code'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" name="postcode_invoice" id="postcode_invoice" data-validate="isPostCode" value="{if isset($guestInformations) && isset($guestInformations.postcode_invoice) && $guestInformations.postcode_invoice}{$guestInformations.postcode_invoice}{/if}"/>
							</div>
						</div>
						{elseif $field_name eq "city"}
						<div class="required form-group uk-form-row">
							<label for="city_invoice" class="uk-form-label">{l s='City'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" name="city_invoice" id="city_invoice" data-validate="isCityName" value="{if isset($guestInformations) && isset($guestInformations.city_invoice) && $guestInformations.city_invoice}{$guestInformations.city_invoice}{/if}" />
							</div>
						</div>
						{elseif $field_name eq "country" || $field_name eq "Country:name"}
						<div class="required form-group uk-form-row">
							<label for="id_country_invoice" class="uk-form-label">{l s='Country'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<select name="id_country_invoice" id="id_country_invoice" class="form-control">
									<option value="">-</option>
									{foreach from=$countries item=v}
									<option value="{$v.id_country}"{if (isset($guestInformations) && isset($guestInformations.id_country_invoice) && $guestInformations.id_country_invoice == $v.id_country) || (!isset($guestInformations) && $sl_country == $v.id_country)} selected="selected"{/if}>{$v.name|escape:'html':'UTF-8'}</option>
									{/foreach}
								</select>
							</div>
						</div>
						{elseif $field_name eq "state" || $field_name eq 'State:name'}
						{$stateExist = true}
						<div class="required id_state_invoice form-group uk-form-row" style="display:none;">
							<label for="id_state_invoice" class="uk-form-label">{l s='State'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<select name="id_state_invoice" id="id_state_invoice" class="form-control">
									<option value="">-</option>
								</select>
							</div>
						</div>
						{/if}
						{/foreach}
						{if !$postCodeExist}
						<div class="required postcode_invoice form-group unvisible uk-form-row">
							<label for="postcode_invoice" class="uk-form-label">{l s='Zip/Postal Code'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" name="postcode_invoice" id="postcode_invoice" data-validate="isPostCode" value="{if isset($guestInformations) && isset($guestInformations.postcode_invoice) && $guestInformations.postcode_invoice}{$guestInformations.postcode_invoice}{/if}"/>
							</div>
						</div>
						{/if}
						{if !$stateExist}
						<div class="required id_state_invoice form-group unvisible uk-form-row">
							<label for="id_state_invoice" class="uk-form-label">{l s='State'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<select name="id_state_invoice" id="id_state_invoice" class="form-control">
									<option value="">-</option>
								</select>
							</div>
						</div>
						{/if}
						{if !$dniExist}
						<div class="required form-group dni_invoice uk-form-row">
							<label for="dni" class="uk-form-label">{l s='Identification number'} <sup>*</sup></label>
							<div class="uk-form-controls">
								<input type="text" class="text form-control validate" name="dni_invoice" id="dni_invoice" data-validate="isDniLite" value="{if isset($guestInformations) && isset($guestInformations.dni_invoice) && $guestInformations.dni_invoice}{$guestInformations.dni_invoice}{/if}" />
								<span class="form_info">{l s='DNI / NIF / NIE'}</span>
							</div>
						</div>
						{/if}
						<div class="form-group is_customer_param uk-form-row">
							<label for="other_invoice" class="uk-form-label">{l s='Additional information'}</label>
							<div class="uk-form-controls">
								<textarea class="form-control" name="other_invoice" id="other_invoice" cols="26" rows="3"></textarea>
							</div>
						</div>
						{if isset($one_phone_at_least) && $one_phone_at_least}
							<p class="inline-infos required is_customer_param">{l s='You must register at least one phone number.'}</p>
						{/if}
						<div class="form-group is_customer_param uk-form-row">
							<label for="phone_invoice" class="uk-form-label">{l s='Home phone'}</label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" name="phone_invoice" id="phone_invoice" data-validate="isPhoneNumber" value="{if isset($guestInformations) && isset($guestInformations.phone_invoice) && $guestInformations.phone_invoice}{$guestInformations.phone_invoice}{/if}" />
							</div>
						</div>
						<div class="{if isset($one_phone_at_least) && $one_phone_at_least}required {/if}form-group uk-form-row">
							<label for="phone_mobile_invoice" class="uk-form-label">{l s='Mobile phone'}{if isset($one_phone_at_least) && $one_phone_at_least} <sup>*</sup>{/if}</label>
							<div class="uk-form-controls">
								<input type="text" class="form-control validate" name="phone_mobile_invoice" id="phone_mobile_invoice" data-validate="isPhoneNumber" value="{if isset($guestInformations) && isset($guestInformations.phone_mobile_invoice) && $guestInformations.phone_mobile_invoice}{$guestInformations.phone_mobile_invoice}{/if}" />
							</div>
						</div>
						<input type="hidden" name="alias_invoice" id="alias_invoice" value="{l s='My Invoice address'}" />
					</div>
					{$HOOK_CREATE_ACCOUNT_FORM}
					<div class="submit opc-add-save clearfix">
						<p class="required opc-required pull-right">
							<sup>*</sup>{l s='Required field'}
						</p>
						<button type="submit" name="submitAccount" id="submitAccount" class="uk-button uk-button-primary"><span>{l s='Save'}<i class="icon-chevron-right right"></i></span></button>

					</div>
					<div style="display: none;" id="opc_account_saved" class="alert alert-success">
						{l s='Account information saved successfully'}
					</div>
				<!-- END Account -->
				</div>
			</div>
		</fieldset>
	</form>
</div>
{strip}
{if isset($guestInformations) && isset($guestInformations.id_state) && $guestInformations.id_state}
	{addJsDef idSelectedState=$guestInformations.id_state|intval}
{else}
	{addJsDef idSelectedState=false}
{/if}
{if isset($guestInformations) && isset($guestInformations.id_state_invoice) && $guestInformations.id_state_invoice}
	{addJsDef idSelectedStateInvoice=$guestInformations.id_state_invoice|intval}
{else}
	{addJsDef idSelectedStateInvoice=false}
{/if}
{if isset($guestInformations) && isset($guestInformations.id_country) && $guestInformations.id_country}
	{addJsDef idSelectedCountry=$guestInformations.id_country|intval}
{else}
	{addJsDef idSelectedCountry=false}
{/if}
{if isset($guestInformations) && isset($guestInformations.id_country_invoice) && $guestInformations.id_country_invoice}
	{addJsDef idSelectedCountryInvoice=$guestInformations.id_country_invoice|intval}
{else}
	{addJsDef idSelectedCountryInvoice=false}
{/if}
{if isset($countries)}
	{addJsDef countries=$countries}
{/if}
{if isset($vatnumber_ajax_call) && $vatnumber_ajax_call}
	{addJsDef vatnumber_ajax_call=$vatnumber_ajax_call}
{/if}
{/strip}
