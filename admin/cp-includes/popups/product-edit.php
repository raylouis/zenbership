<?php/** * * * Zenbership Membership Software * Copyright (C) 2013-2016 Castlamp, LLC * * This program is free software: you can redistribute it and/or modify * it under the terms of the GNU General Public License as published by * the Free Software Foundation, either version 3 of the License, or * (at your option) any later version. * * This program is distributed in the hope that it will be useful, * but WITHOUT ANY WARRANTY; without even the implied warranty of * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the * GNU General Public License for more details. * * You should have received a copy of the GNU General Public License * along with this program.  If not, see <http://www.gnu.org/licenses/>. * * @author      Castlamp * @link        http://www.castlamp.com/ * @link        http://www.zenbership.com/ * @copyright   (c) 2013-2016 Castlamp * @license     http://www.gnu.org/licenses/gpl-3.0.en.html * @project     Zenbership Membership Software */// Check permissions, ownership,// and if it exists.$permission = 'product-edit';$check = $admin->check_permissions($permission, $employee);if ($check != '1') {    $admin->show_no_permissions($error, '', '1');} else {    $cart   = new cart;    $data   = $cart->get_product($_POST['id']);    $upsell = $cart->get_upsell($_POST['id']);    ?>    <script type="text/javascript">        $.ctrl('S', function () {            //submit_product();            return json_add('product-add', '<?php echo $data['data']['id']; ?>', '1', 'popupform');        });    </script>    <form action="" method="post" id="popupform"          onsubmit="return json_add('product-add','<?php echo $data['data']['id']; ?>','1','popupform');">    <div id="popupsave">        <input type="button" value="Cancel" onclick="return close_large_popup();"/>        <input type="submit" class="save" value="Save"/>        <input type="hidden" class="original_id" value="<?php echo $data['data']['id']; ?>"/>    </div>    <h1>Editing Product</h1>    <ul id="theStepList">        <li class="on" onclick="return goToStep('0');">Overview</li>        <li onclick="return goToStep('1');">Product Type &amp; Price</li>        <li onclick="return goToStep('2');">Terms</li>        <li onclick="return goToStep('3');">Dependencies</li>        <li onclick="return goToStep('4');">Content Access</li>        <li onclick="return goToStep('5');">Options</li>        <li onclick="return goToStep('6');">Volume Pricing</li>        <li onclick="return goToStep('7');">Media</li>        <li onclick="return goToStep('8');">Upsell</li>    </ul>    <div class="pad24t popupbody">    <ul id="formlist">    <li class="form_step">        <fieldset>            <legend>Basic Overview</legend>            <div class="pad24t">                <div class="field">                    <label>ID</label>                    <div class="field_entry">                        <input type="text" name="product[id]" id="p0121" maxlength="35"                               value="<?php echo $data['data']['id']; ?>" class="req" style="width:250px;"/>                    </div>                </div>                <div class="field">                    <label>Status</label>                    <div class="field_entry">                        <input type="radio" name="product[hide]" value="0" <?php if ($data['data']['hide'] != '1') {                            echo " checked=\"checked\"";                        } ?> /> Live<br /><input type="radio" name="product[hide]"                                            value="2"  <?php if ($data['data']['hide'] == '2') {                            echo " checked=\"checked\"";                        } ?> /> Hidden (Not visible in store front, but can be purchased)<br /><input type="radio" name="product[hide]"                                            value="1"  <?php if ($data['data']['hide'] == '1') {                            echo " checked=\"checked\"";                        } ?> /> Bookkeeping Only (Cannot be purchased or seen in store front)                    </div>                </div>                <div class="field">                    <label>Category</label>                    <div class="field_entry">                        <select name="product[category]" style="width:250px;">                            <?php                            echo $admin->cart_category_select($data['data']['category']);                            ?>                        </select>                    </div>                </div>                <div class="field">                    <label>Name</label>                    <div class="field_entry">                        <input type="text" name="product[name]" value="<?php echo $data['data']['name']; ?>" id="p01"                               maxlength="100" class="req" style="width:250px;"/>                    </div>                </div>                <div class="field">                    <label>Tagline</label>                    <div class="field_entry">                        <input type="text" name="product[tagline]" id="p02"                               value="<?php echo $data['data']['tagline']; ?>" maxlength="150" class=""                               style="width:250px;"/>                    </div>                </div>                <div class="field">                    <label class="top">Description</label>                    <div class="clear"></div>                    <div class="field_entry_top">                        <textarea name="product[description]" class="richtext" id="event_rich"                                  style="width:100%;height:150px;"><?php echo $data['data']['description']; ?></textarea>                        <?php                        // Not working for some reason...                        echo $admin->richtext('100%', '200px', 'event_rich');                        ?>                    </div>                </div>                <div class="field">                    <label>Base Popularity</label>                    <div class="field_entry">                        <input type="text" name="product[base_popularity]" maxlength="5" id="p054" class="zen_num"                               value="<?php echo $data['data']['base_popularity']; ?>" style="width:90px;"/>                        <p class="field_desc">This number will be added to the product's actual popularity.</p>                    </div>                </div>                <div class="field">                    <label>SyncId</label>                    <div class="field_entry">                        <input type="text" name="product[sync_id]" id="p01215" maxlength="35" value="<?php echo $data['data']['sync_id']; ?>"                               class="" style="width:250px;"/>                        <p class="field_desc">Optional "SyncId" used for development and external service matching.</p>                    </div>                </div>            </div>        </fieldset>        <fieldset>            <legend>Limits</legend>            <div class="pad24t">                <div class="col50l">                    <div class="field">                        <label>Max Per Cart</label>                        <div class="field_entry">                            <input type="text" name="product[max_per_cart]" maxlength="5" id="p04" class="zen_num"                                   style="width:90px;" value="<?php echo $data['data']['max_per_cart']; ?>" />                            <p class="field_desc">Leave blank to not limit how many a user can add into his/her cart.</p>                        </div>                    </div>                </div>                <div class="col50r">                    <div class="field">                        <label>Minimum Per Cart</label>                        <div class="field_entry">                            <input type="text" name="product[min_per_cart]" maxlength="5" id="p04" class="zen_num"                                   style="width:90px;" value="<?php echo $data['data']['min_per_cart']; ?>" />                            <p class="field_desc">Leave blank for no minimum requirement.</p>                        </div>                    </div>                </div>                <div class="clear"></div>                <div class="field">                    <label>Tax Exemption</label>                    <div class="field_entry">                        <input type="radio" name="product[tax_exempt]"                               value="0" <?php if ($data['data']['tax_exempt'] != '1') {                            echo " checked=\"checked\"";                        } ?> /> No <input type="radio" name="product[tax_exempt]"                                          value="1" <?php if ($data['data']['tax_exempt'] == '1') {                            echo " checked=\"checked\"";                        } ?> /> Yes                    </div>                </div>            </div>        </fieldset>    </li>    <li class="form_step">    <fieldset>        <legend>Product Type</legend>        <div class="pad24t">            <div class="col50l">                <div class="field">                    <label>Type</label>                    <div class="field_entry">                        <input type="radio" name="product[type]" value="1" <?php if ($data['data']['type'] == '1') {                            echo " checked=\"checked\"";                        } ?> /> One-time purchase<br/>                        <input type="radio" name="product[type]" value="2"  <?php if ($data['data']['type'] == '2') {                            echo " checked=\"checked\"";                        } ?> /> Subscription product<br/>                        <input type="radio" name="product[type]" value="3"  <?php if ($data['data']['type'] == '3') {                            echo " checked=\"checked\"";                        } ?> /> Subscription product with trial period                    </div>                </div>                <div class="field">                    <label>Tangible</label>                    <div class="field_entry">                        <input type="radio" name="product[physical]"                               value="1"  <?php if ($data['data']['physical'] == '1') {                            echo " checked=\"checked\"";                        } ?> /> Physical product<br /><input type="radio" name="product[physical]"                                                        value="0"  <?php if ($data['data']['physical'] != '1') {                            echo " checked=\"checked\"";                        } ?> /> Non-physical product                    </div>                </div>            </div>            <div class="col50r">                <div class="field">                    <label>Accessibility</label>                    <div class="field_entry">                        <input type="radio" name="product[members_only]"                               value="1" <?php if ($data['data']['members_only'] == '1') {                            echo " checked=\"checked\"";                        } ?> /> Membership Required<br/>                        <input type="radio" name="product[members_only]"                               value="0" <?php if ($data['data']['members_only'] != '1') {                            echo " checked=\"checked\"";                        } ?> /> No Membership Required                    </div>                </div>                <div class="field">                    <label>Auto-Register?</label>                    <div class="field_entry">                        <input type="radio" name="product[auto_register]" value="1" <?php if ($data['data']['auto_register'] == '1') {                            echo " checked=\"checked\"";                        } ?>/> Auto-register non-members.<br/>                        <input type="radio" name="product[auto_register]" value="0" <?php if ($data['data']['auto_register'] != '1') {                            echo " checked=\"checked\"";                        } ?>/> Do not auto-register non-members.                    </div>                </div>                <div class="field">                    <label>Featured?</label>                    <div class="field_entry">                        <input type="radio" name="product[featured]" value="1" <?php if ($data['data']['featured'] == '1') {                            echo " checked=\"checked\"";                        } ?> /> Featured Product<br/>                        <input type="radio" name="product[featured]" value="0" <?php if ($data['data']['featured'] != '1') {                            echo " checked=\"checked\"";                        } ?> /> Not Featured                    </div>                </div>            </div>            <div class="clear"></div>        </div>    </fieldset>    <fieldset>        <legend>Base Price</legend>        <div class="pad24t">            <div class="field">                <label>Price</label>                <div class="field_entry">                    <?php                    echo $db->place_currency('<input type="text" name="product[price]" id="p03" maxlength="10" class="req zen_money" style="width:100px;" value="' . $data['data']['price'] . '" />', '0');                    ?>                </div>            </div>        </div>    </fieldset>    <fieldset style="display:<?php if ($data['data']['type'] == '1') {        echo "block;";    } else {        echo "none";    } ?>;" class="ptype" id="sub_1">        <legend>Single Purchase Product</legend>        <div class="pad24t">            <p>No additional options.</p>        </div>    </fieldset>    <fieldset style="display:<?php if ($data['data']['type'] == '2' || $data['data']['type'] == '3') {        echo "block;";    } else {        echo "none";    } ?>;" class="ptype" id="sub_2">        <legend>Subscription Product</legend>        <div class="pad24t">            <div class="field">                <label>Renewal Timeframe</label>                <div class="field_entry">                    <?php                    echo $admin->timeframe_field('product[renew_timeframe]', $data['data']['renew_timeframe'], '0', '1');                    ?>                </div>            </div>            <div class="field">                <label>Max Renewals</label>                <div class="field_entry">                    <input type="text" name="product[renew_max]" maxlength="5"                           value="<?php echo $data['data']['renew_max']; ?>" id="p05" class="zen_num"                           style="width:90px;"/>                    <p class="field_desc">Leave blank to not stop charging this subscription.</p>                </div>            </div>        </div>    </fieldset>    <fieldset style="display:<?php if ($data['data']['type'] == '3') {        echo "block;";    } else {        echo "none";    } ?>;" class="ptype" id="sub_3">        <legend>Subscription Product with Trial Period</legend>        <div class="pad24t">            <div class="field">                <label>Price</label>                <div class="field_entry">                    <?php                    echo $db->place_currency('<input type="text" name="product[trial_price]" id="p06" value="' . $data['data']['trial_price'] . '" maxlength="10" class="zen_money" style="width:100px;" />', '0');                    ?>                </div>            </div>            <div class="field">                <label>Timeframe</label>                <div class="field_entry">                    <?php                    echo $admin->timeframe_field('product[trial_period]', $data['data']['trial_period'], '0');                    ?>                </div>            </div>            <div class="field">                <label>Repeat</label>                <div class="field_entry">                    <input type="text" name="product[trial_repeat]" value="<?php echo $data['data']['trial_repeat']; ?>"                           maxlength="5" id="p07" class="zen_num" style="width:90px;"/>                    <p class="field_desc">The program gives you the option to repeat the trial period. Leave blank for a                        one-time only trial period.</p>                </div>            </div>        </div>    </fieldset>    <fieldset style="display:none;" class="" id="physical">        <legend>Physical Product</legend>        <div class="pad24t">            <div class="field">                <label>Weight</label>                <div class="field_entry">                    <input type="text" name="product[weight]" maxlength="5"                           value="<?php echo $data['data']['weight']; ?>" class="" style="width:80px;"/>                </div>            </div>        </div>    </fieldset>    </li>    <li class="form_step">        <fieldset>            <legend>Term Agreement</legend>            <div class="pad24t">                <div class="field">                    <label>Require Terms?</label>                    <div class="field_entry">                        <input type="radio" name="terms[existing]" <?php if (empty($data['data']['terms'])) {                            echo " checked=\"checked\"";                        } ?> value="none" checked="checked"                               onclick="return swap_multi_div('terms_set_1','terms_set_2,terms_set_3');"/> None<br/>                        <input type="radio" name="terms[existing]" <?php if (!empty($data['data']['terms'])) {                            echo " checked=\"checked\"";                        } ?> value="existing"                               onclick="return swap_multi_div('terms_set_2','terms_set_1,terms_set_3');"/> Existing                        Terms<br/>                        <input type="radio" name="terms[existing]" value="terms"                               onclick="return swap_multi_div('terms_set_3','terms_set_1,terms_set_2');"/> New Terms                    </div>                </div>                <div id="terms_set_1" style="display:<?php if (empty($data['data']['terms'])) {                    echo "block";                } else {                    echo "none";                } ?>;"></div>                <div id="terms_set_2" style="display:<?php if (!empty($data['data']['terms'])) {                    echo "block";                } else {                    echo "none";                } ?>;">                    <div class="field">                        <label>Existing Terms</label>                        <div class="field_entry">                            <select name="terms[id]" style="width:300px;">                                <?php                                if (!empty($data['data']['terms'])) {                                    echo $admin->list_terms($data['data']['terms']);                                } else {                                    echo $admin->list_terms();                                }                                ?>                            </select>                        </div>                    </div>                </div>                <div id="terms_set_3" style="display:none;">                    <div class="field">                        <label>Terms Title</label>                        <div class="field_entry">                            <input type="text" name="terms[name]" id="p0125" maxlength="100" style="width:250px;"/>                        </div>                    </div>                    <div class="field">                        <label class="top">New Terms</label>                        <div class="clear"></div>                        <div class="field_entry_top">                            <textarea name="terms[data]" class="richtext" id="event_terms_rich"                                      style="width:100%;height:300px;"></textarea>                            <?php                            // Not working for some reason...                            echo $admin->richtext('100%', '300px', 'event_terms_rich');                            ?>                        </div>                    </div>                </div>            </div>        </fieldset>    </li>    <li class="form_step">        <div class="field">            <label>Form</label>            <div class="field_entry">                <select name="dependency[form_id]" style="width:300px;">                    <option value=""></option>                    <?php                    $forms = $admin->get_forms('dependency', $data['dependencies']['form_id']);                    echo $forms;                    ?>                </select>            </div>            <p class="field_desc">If you would like to collect additional information when this product is purchased,                select a dependency form from the list above.</p>        </div>        <div class="field" id="form_dep">            <label>Form Qty</label>            <div class="field_entry">                <input type="radio" name="dependency[form_multi]"                       value="1" <?php if ($data['dependencies']['form_options']['form_multi'] == '1') {                    echo " checked=\"checked\"";                } ?> /> Only one form required<br/>                <input type="radio" name="dependency[form_multi]"                       value="2" <?php if ($data['dependencies']['form_options']['form_multi'] != '1') {                    echo " checked=\"checked\"";                } ?> /> One form per item in cart.            </div>            <p class="field_desc">Would you like to collect one form total or one form per quantity in the cart?</p>        </div>    </li>    <li class="form_step">        <?php        if (! empty($data['data']['member_type'])) {            $user = new user;            $member_type = $user->get_member_type($data['data']['member_type']);            $mt_name = $member_type['name'];            $mt_id = $data['data']['member_type'];        } else {            $mt_name = '';            $mt_id = '';        }        ?>        <p class="highlight">Input a member type from the following field if you want to assign members purchasing this product to a specific member group.</p>        <fieldset>            <div class="pad24t">                <div class="field">                    <label>Member Type</label>                    <div class="field_entry">                        <input type="text" value="<?php echo $mt_name; ?>" name="member_type_dud" id="member_typed"                               autocomplete="off" onkeyup="return autocom(this.id,'id','name','ppSD_member_types','name','member_types');"                               style="width:250px;"/><a href="null.php" onclick="return get_list('member_types','member_typed_id','member_typed');"><img                                src="imgs/icon-list.png" width="16" height="16" border="0" alt="Select from list"                                title="Select from list" class="icon-right"/></a>                        <input type="hidden" name="product[member_type]" id="member_typed_id" value="<?php echo $mt_id; ?>"/>                    </div>                </div>            </div>        </fieldset>        <p class="highlight">If you selected a "Member Type" to which this product will assign members purchasing it, the following content will be assigned to the member as well as the content package assigned by the member type. Note that you do not need to select a member type. Likewise, selecting additional content is optional.</p>        <table cellspacing="0" class="generic" cellpadding="0" border="0" id="content_options">            <thead>            <tr>                <th>Content</th>                <th width="200">Timeframe</th>                <th width="16"></th>            </tr>            </thead>            <tbody>            <?php            $num = 0;            $content = new content;            foreach ($data['content'] as $content) {                $num++;                $get = $admin->cell_content_grant($num, $content['id']);                echo $get;            }            ?>            </tbody>        </table>        <script type="text/javascript">            content = <?php echo $num; ?>;        </script>        <a class="submit" href="returnnull.php" onclick="return addcontent();">Add Content Access</a>    </li>    <li class="form_step">        <div id="stock_options"><?php            $options = 1;            $inner_options = 1;            foreach ($data['options'] as $aOption) {                echo $admin->cell_product_option($options, $aOption['id']);                $options++;            }            ?></div>        <a class="submit" href="#" onclick="return addoption();">Add a Product Option</a>        <script type="text/javascript">            var option = <?php echo $options; ?>;            var inner_option = <?php echo $inner_options; ?>;        </script>    </li>    <li class="form_step">        <p class="highlight"><a href="http://documentation.zenbership.com/Shop/Volume-Pricing" target="_blank">Click here</a> for information on volume pricing.</p>        <table cellspacing="0" class="generic" cellpadding="0" border="0" id="tier_options">            <thead>            <tr>                <th width="100">Qty Low</th>                <th width="100">Qty High</th>                <th>Discount (%)</th>                <th width="16"></th>            </tr>            </thead>            <tbody>            <?php            $tiers = 0;            foreach ($data['tiers'] as $aTier) {                $tiers++;                echo $admin->cell_product_tier($tiers, $aTier['id']);            }            ?>            </tbody>        </table>        <a class="submit" href="#" onclick="return addtier();">Add a Volume Tier</a>        <script type="text/javascript">            tiers = <?php echo $tiers; ?>;        </script>    </li>    <li class="form_step">        <div class="col50l">            <div class="field" id="event_cover_photo">                <label class="top">Upload a Thumbnail</label>                <script type="text/javascript" src="js/jquery.fileuploader.js"></script>                <script type="text/javascript">                    $(document).ready(function () {                        var uploader = new qq.FileUploader({                            element: document.getElementById('fileuploader'),                            action: 'cp-functions/upload.php',                            debug: true,                            params: {                                type: 'product',                                id: '<?php echo $data['data']['id']; ?>',                                permission: 'product-upload-cover',                                label: 'cover-photo',                                scope: '0'                            }                        });                    });                </script>                <p>Drag and drop a thumbnail photo here.<br/><br/>The program will attempt to auto-resize large images,                    but for best results, ideally, a cover photo should be 1:1 ratio and bigger than 200 pixels.</p>                <div id="fileuploader">                    <noscript><p>Please enable JavaScript to use file uploader.</p></noscript>                </div>            </div>        </div>        <div class="col50r">            <div class="field" id="event_photos">                <label class="top">Upload Additional Photos</label>                <script type="text/javascript">                    $(document).ready(function () {                        var uploader = new qq.FileUploader({                            element: document.getElementById('fileuploaderA'),                            action: 'cp-functions/upload.php',                            debug: true,                            params: {                                type: 'product',                                id: '<?php echo $data['data']['id']; ?>',                                permission: 'product-thumbnail',                                label: 'thumbnail',                                scope: '0'                            }                        });                    });                </script>                <p>Drag and drop a additional product photos here.<br/><br/>There is no limit to how many additional                    photos you can add, however some themes may benefits from limiting the number to 2-4.</p>                <div id="fileuploaderA">                    <noscript><p>Please enable JavaScript to use file uploader.</p></noscript>                </div>            </div>        </div>        <div class="clear"></div>    </li>    <li class="form_step">        <script>            $(function () {                var fixHelper = function (e, ui) {                    ui.children().each(function () {                        $(this).width($(this).width());                    });                    return ui;                };                $("#upsell_options tbody").sortable({                    helper: fixHelper,                    handle: ".handle"                }); // .disableSelection();            });        </script>        <table cellspacing="0" class="generic" cellpadding="0" border="0" id="upsell_options">            <thead>            <tr>                <th width="16"></th>                <th>Product</th>                <th width="200">When?</th>                <th width="16"></th>            </tr>            </thead>            <tbody>            <?php            $num = 0;            foreach ($upsell as $product) {                $num++;                $get = $admin->cell_upsell($product['upsell'], $product['type']);                echo $get;            }            ?>            </tbody>        </table>        <a class="submit" href="returnnull.php" onclick="return add_upsell();">Add Upsell Product</a>    </li>    </ul>    </div>    </form>    <script src="js/form_rotator.js" type="text/javascript"></script>    <script type="text/javascript" src="js/event_actions.js"></script><?php}?>