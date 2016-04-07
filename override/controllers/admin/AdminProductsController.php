<?php
/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @property Product $object
 */
class AdminProductsController extends AdminProductsControllerCore
{
    protected $_defaultOrderBy = 'position';
    protected $_defaultOrderWay = 'DESC';

    protected function _displayLabelField(&$label, $languages, $default_language, $type, $fieldIds, $id_customization_field)
    {
        foreach ($languages as $language) {
            $input_value[$language['id_lang']] = (isset($label[(int)($language['id_lang'])])) ? $label[(int)($language['id_lang'])]['name'] : '';
        }

        $required = (isset($label[(int)($language['id_lang'])])) ? $label[(int)($language['id_lang'])]['required'] : false;

		global $all_options;
		$all_options_str = '';
		if ($all_options) {
			foreach ($all_options as $option) {
				$all_options_str .= '<option'
					.((isset($input_value['1']) && strtolower($option['option_label'])==strtolower($input_value['1']))?' selected':'')
					.' value="'.htmlspecialchars($option['option_label']).'">'.$option['option_label'].'</option>';
			}
		}

        $template = $this->context->smarty->createTemplate('controllers/products/input_text_lang.tpl',
            $this->context->smarty);
        return '<div class="form-group">'
            .'<div class="col-lg-5">'
            .$template->assign(array(
                'languages' => $languages,
                'input_name'  => 'label_'.$type.'_'.(int)($id_customization_field),
                'input_value' => $input_value
            ))->fetch()
            .'</div>'
            .'<div class="col-lg-2">'
            .'<div class="checkbox">'
            .'<label for="require_'.$type.'_'.(int)($id_customization_field).'">'
            .'<input type="checkbox" name="require_'.$type.'_'.(int)($id_customization_field).'" id="require_'.$type.'_'.(int)($id_customization_field).'" value="1" '.($required ? 'checked="checked"' : '').'/>'
            .$this->l('Required')
            .'</label>'
            .'</div>'
            .'</div>'
			.'<div class="col-lg-5">
				<select name="select_'.$type.'_'.(int)($id_customization_field).'">
				<option></option>
				'.$all_options_str.'
				</select>
				</div>'
            .'</div>';
    }

    /**
     * @param Product $obj
     * @throws Exception
     * @throws SmartyException
     */
    public function initFormCustomization($obj)
    {
        $data = $this->createTemplate($this->tpl_form);

        if ((bool)$obj->id) {
            if ($this->product_exists_in_shop) {
                $labels = $obj->getCustomizationFields();

                $has_file_labels = (int)$this->getFieldValue($obj, 'uploadable_files');
                $has_text_labels = (int)$this->getFieldValue($obj, 'text_fields');

				global $all_options;
				$all_options = array();
				$table_exist_rec = Db::getInstance()->executeS("SHOW TABLES LIKE 'px_custom_options'");
				if ($table_exist_rec) {
					$all_options = Db::getInstance()->executeS("
					select distinct co.option_label
					from px_custom_options co
					where co.deleted=0
					order by co.add_time asc
					");
				}
				//$data->assign('all_options', $all_options);

                $data->assign(array(
                    'obj' => $obj,
                    'table' => $this->table,
                    'languages' => $this->_languages,
                    'has_file_labels' => $has_file_labels,
                    'display_file_labels' => $this->_displayLabelFields($obj, $labels, $this->_languages, Configuration::get('PS_LANG_DEFAULT'), Product::CUSTOMIZE_FILE),
                    'has_text_labels' => $has_text_labels,
                    'display_text_labels' => $this->_displayLabelFields($obj, $labels, $this->_languages, Configuration::get('PS_LANG_DEFAULT'), Product::CUSTOMIZE_TEXTFIELD),
                    'uploadable_files' => (int)($this->getFieldValue($obj, 'uploadable_files') ? (int)$this->getFieldValue($obj, 'uploadable_files') : '0'),
                    'text_fields' => (int)($this->getFieldValue($obj, 'text_fields') ? (int)$this->getFieldValue($obj, 'text_fields') : '0'),
                ));
            } else {
                $this->displayWarning($this->l('You must save the product in this shop before adding customization.'));
            }
        } else {
            $this->displayWarning($this->l('You must save this product before adding customization.'));
        }

        $this->tpl_form_vars['custom_form'] = $data->fetch();
    }
}
