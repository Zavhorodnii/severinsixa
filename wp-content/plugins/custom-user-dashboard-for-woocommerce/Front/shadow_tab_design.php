<?php
global $wpdb;
$user_meta=get_userdata(get_current_user_ID());
$user_roles=$user_meta->roles;

$wpdb->woospca_custom_endpoints = $wpdb->prefix . 'woospca_custom_endpoints';
$woospca_all_endpoints_withgrp = $wpdb->get_results( 'SELECT woospca_id, woospca_customer_role FROM ' . $wpdb->woospca_custom_endpoints );

$woospca__ids='';

foreach ($woospca_all_endpoints_withgrp as $key => $value) {

	if ('' == $value->woospca_customer_role || 's:0:"";' == $value->woospca_customer_role || 'N;' == $value->woospca_customer_role) {
		$woospca_arrrrrrrr=array();
		if ('' == $woospca__ids) {
			$woospca__ids=' WHERE woospca_id = ' . $value->woospca_id;
		} else {
			$woospca__ids=$woospca__ids . ' OR woospca_id = ' . $value->woospca_id;
		}
	} else {
		$woospca_arrrrrrrr=unserialize($value->woospca_customer_role);
	}

	foreach ($woospca_arrrrrrrr as $key1 => $value1) {
		if (in_array($value1, $user_roles)) {

			if ('' == $woospca__ids) {
				$woospca__ids=' WHERE woospca_id = ' . $value->woospca_id;
			} else {
				$woospca__ids=$woospca__ids . ' OR woospca_id = ' . $value->woospca_id;
			}
			
		}
	}

}
if (isset($_GET['i'])) {
	$woospca_iiii=sanitize_text_field($_GET['i']);
}
$wpdb->woospca_custom_endpoints = $wpdb->woospca_custom_endpoints . $woospca__ids;

$woospca_all_endpoints_withgrp = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->woospca_custom_endpoints . ' ORDER BY woospca_sort_order ASC');

$upload_dir = wp_upload_dir();
$baseurl='';
if ( ! empty( $upload_dir['baseurl'] ) ) {
	$baseurl = $upload_dir['baseurl'] . '/Uploaded_users_images/';
}

$activegroponload=false;
$current_user_woospca=wp_get_current_user();
$current_user_name=ucfirst($current_user_woospca->display_name);
$woospca_existed_user_profile=get_user_meta(get_current_user_ID(), '_woospca_current_user_profile', true);
if ('' == $woospca_existed_user_profile) {
	$woospca_existed_user_profile='dummy.jpeg';
}
$current_user_profile_url=$baseurl . $woospca_existed_user_profile;
?>

<div class="container" style="margin:1%;width: 98%;box-shadow: 0px 5px 20px 3px rgba(0, 0, 0, 0.2), 1px 2px 11px 2px rgba(0, 0, 0, 0.29);border-radius: 4px;">
	<div class="row woospca_vis_hdddn" style="width: 100%;padding: 10px;filter: blur(6px);">
		<div  style="width: 100%;">
			<div class="tab" role="tabpanel" style="width: 100%;">
				<?php
				if ( preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)) ) {		



					?>
					<table style="width: 100%;" id="my_table_for_front_woospca">
						<tr>
							<td style="width: 100%;vertical-align: top;">


								<ul class="nav nav-tabs plugify_nav" role="tablist" style="margin-left: unset;display: unset;">
									
									<center>
										<li style="width: auto;display: contents !important;">
											<?php
											if ('true' == $woospca_is_avatar) {
												?>
												<div class="container123">

													<div class="avatar-upload">
														<?php
														if ('true' == $woospca_is_upload_avatar) {
															?>
															<div class="avatar-edit">
																<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
																<label for="imageUpload">
																	<i style="position:absolute;top:8px;left:10px;" class="fa fa-fw fa-pencil-square-o"></i>
																</label>
															</div>
															<?php
														}
														?>


														<img  class="avatar-preview" id="imagePreview" src="<?php echo filter_var($current_user_profile_url); ?>">


													</div>
												</div>
												<?php
											}
											?>
											<center>
												<strong style="font-size: 18px;"><?php echo esc_attr($current_user_name); ?></strong>
											</center>
											<center>
												<span style="font-size: 13px;"><?php echo esc_attr($current_user_woospca->user_email); ?></span>
											</center>
											<?php
											if ('true' == $woospca_is_logout) {
												?>
												<center> 
													<button class="button-primary logout_woospca_btn" value="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" style="color:#<?php echo filter_var( $woospca_d_t_c); ?>;background: #<?php echo filter_var($woospca_d_bg_c); ?>;border-radius: 4px;padding: 4px 6px 4px 6px;">Logout <i class="fas fa-sign-out-alt"></i>
													</button>
												</center>
												<?php
											}
											?>
										</li>
									</center>
									<?php
									
										
									$activegroponload=false;
									foreach ($woospca_all_endpoints_withgrp as $key => $value) {

										if (isset($woospca_iiii) && 'orders' == $value->woospca_slug) {
											$namee=$value->woospca_name . ' (View Mode)';
										} else if ( isset($_GET['e']) && 'edit-address' == $value->woospca_slug ) {
											$namee=$value->woospca_name . ' (Edit Mode)';
										} else {
											$namee=$value->woospca_name;
										}												
										?>
										<li role="presentation"
										<?php 
										if ('111' == $value->woospca_is_hide ) {
											echo filter_var('style="display:none;"');
										} 
										if ('link' == $value->woospca_type ) {
											echo filter_var('target="' . $value->woospca_new_tab . '"');
											echo filter_var('linktopage="' . $value->woospca_children . '"');
										} else if ('page' == $value->woospca_type) {
											echo filter_var('target="' . $value->woospca_new_tab . '"'); 
											echo filter_var('linktopage="' . get_permalink($value->woospca_children) . '"');
										} else if ('group' == $value->woospca_type) {
											echo filter_var('special="' . $value->woospca_id . '"'); 
										}
										if ('0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be'])) { 
											if ('group' == $value->woospca_type) {
												$activegroponload=true;

											} else {
												echo filter_var('class="active"');
											}
										} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
											echo filter_var('class="active"');
										} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
											echo filter_var('class="active"');
										} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
											echo filter_var('class="active"');
										} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
											echo filter_var('class="active"');
										} 
										?>
										>
										<?php

										if ('endpoint' == $value->woospca_type) {
											?>
											<a href="#Section<?php echo filter_var($value->woospca_slug); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?>
												
											</a>
												<?php

										} else if ('link' == $value->woospca_type) {
											?>
											<a href="<?php echo filter_var($value->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?>
												
											</a>
												<?php

										} else if ('page' == $value->woospca_type) {
											?>
											<a href="<?php echo filter_var(get_permalink($value->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
												<?php
										} else if ('group'==$value->woospca_type) {
											?>
											<div class="dropdown" style="top: 100% !important;">
												<a class="dropbtn dropbtn<?php echo filter_var($value->woospca_id); ?>" ><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
												<div class="dropdown-content animate__animated animate__fadeInDown" style="top:100.12% !important;">
													<?php
													foreach (unserialize($value->woospca_children) as $key_s => $value_s) {

														global $wpdb;
														$wpdb->woospca_custom_endpoints = $wpdb->prefix . 'woospca_custom_endpoints';
														$woospca_result=$wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->woospca_custom_endpoints . ' WHERE woospca_id = %d', intval($value_s) ) );
														?>
														<?php
														if ('endpoint' == $woospca_result[0]->woospca_type) {
															?>
															<a href="#Section<?php echo filter_var($woospca_result[0]->woospca_slug); ?>" ><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?>
																
															</a>
															<?php

														} else if ('link' == $woospca_result[0]->woospca_type) {
															?>
															<a href="" linktopage="<?php echo filter_var($woospca_result[0]->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?>
																
															</a>
															<?php

														} else if ('page' == $woospca_result[0]->woospca_type) {
															?>
															<a href="" linktopage="<?php echo filter_var(get_permalink($woospca_result[0]->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?>
																
															</a>
															<?php
														}																

													}
													?>

												</div>
											</div>

											<?php
										}
										?>

										</li>
										<?php											
									}
									?>
								</ul>
							</td>
						</tr>
						<tr style="width: 100%;vertical-align: top;">		
							<td>						

								<div class="tab-content tabs" style="margin-left: 2%;">

									<?php
									foreach ($woospca_all_endpoints_withgrp as $key => $value) {
										?>
										<div role="tabpanel" id="Section<?php echo filter_var($value->woospca_slug); ?>" class="tab-pane fade in 
											<?php 
											if ('111'==$value->woospca_is_hide) {
												echo filter_var('style="display:none;"');
											} 
											if ( '0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be']) ) {
												echo filter_var('active');
											} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
												echo filter_var('active');
											} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
												echo filter_var('active');
											} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
												echo filter_var('active');
											} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
												echo filter_var('active');
											} 
											?>
											" >
											<?php
											if ('1'==$value->woospca_default) {

												if ('dashboard' == $value->woospca_slug) {
													echo filter_var('<h1 class="hdngg_woospca">Dashboard</h1><hr>');
													if ('before' == $value->woospca_children) {
														echo filter_var($value->woospca_content);
														include 'dashboard_template.php';
													} else if ('override' == $value->woospca_children) {
														echo filter_var($value->woospca_content);

													} else {
														include 'dashboard_template.php';
														echo filter_var($value->woospca_content);
													}




												} else if ('edit-account' == $value->woospca_slug) {
													echo filter_var( '<h1 class="hdngg_woospca">Account Details</h1><hr>');
													if ('before' == $value->woospca_children) {
														echo filter_var( $value->woospca_content);
														include 'edit_account_template.php';
													} else if ('override' == $value->woospca_children) {
														echo filter_var( $value->woospca_content);

													} else {
														include 'edit_account_template.php';
														echo filter_var( $value->woospca_content);
													}

												} else if ('orders' == $value->woospca_slug) {
													if ( isset($woospca_iiii) ) {
														$order_id=$woospca_iiii;
														
														echo filter_var( '<h1 class="hdngg_woospca">Orders</h1><hr>');
														include 'view_order.php';
													} else {
														echo filter_var( '<h1 class="hdngg_woospca">Orders</h1><hr>');
														if ('before' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);
															include 'orders_template.php';
														} else if ('override' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);

														} else {
															include 'orders_template.php';
															echo filter_var( $value->woospca_content);
														}

													}													

												} else if ('downloads' == $value->woospca_slug) {
													echo filter_var( '<h1 class="hdngg_woospca">Downloads</h1><hr>');
													if ('before' == $value->woospca_children) {
														echo filter_var( $value->woospca_content);
														include 'downloads.php';
													} else if ('override' == $value->woospca_children) {
														echo filter_var( $value->woospca_content);

													} else {
														include 'downloads.php';
														echo filter_var( $value->woospca_content);
													}


												} else if ('edit-address' == $value->woospca_slug) {
													if ( isset($_GET['e']) ) {	
														echo filter_var( '<h1 class="hdngg_woospca">Address</h1><hr>');													
														include 'form_edit_address.php';
													} else {
														echo filter_var( '<h1 class="hdngg_woospca">Address</h1><hr>');
														if ('before' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);
															include 'edit_address.php';
														} else if ('override' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);

														} else {
															include 'edit_address.php';
															echo filter_var( $value->woospca_content);
														}

													}													

												}
											} else {												
												echo filter_var($value->woospca_content);										
											}
											?>
											</div>
										<?php
									}

									?>
								</div>
								</td>
							</tr>
						</table>
								<?php


				} else {
					if ('topside' == $woospca_menu_pos) {
						?>
				<style type="text/css">
							 .nav-tabs>li{width: auto !important;}
						</style>
			<table style="width: 100%;" id="my_table_for_front_woospca">

				<tr>

					<td style="width: 100%;vertical-align: top;">

						<ul class="nav nav-tabs plugify_nav" role="tablist" style="display:contents;margin-top: 15px !important;">
							
								<li style="width: auto;">
									<?php
									if ('true' == $woospca_is_avatar) {
										?>
										<div class="container123">

											<div class="avatar-upload">
												<?php
												if ('true' == $woospca_is_upload_avatar) {
													?>
													<div class="avatar-edit">
														<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
														<label for="imageUpload">
															<i style="position:absolute;top:8px;left:10px;" class="fa fa-fw fa-pencil-square-o"></i>
														</label>
													</div>
													<?php
												}
												?>


												<img  class="avatar-preview" id="imagePreview" src="<?php echo filter_var($current_user_profile_url); ?>">


											</div>
										</div>
										<?php
									}
									?>
									<center>
										<strong style="font-size: 18px;"><?php echo esc_attr($current_user_name); ?></strong>
									</center>
									<center>
										<span style="font-size: 13px;"><?php echo esc_attr($current_user_woospca->user_email); ?></span>
									</center>
									<?php
									if ('true' == $woospca_is_logout) {
										?>
										<center> 
											<button class="button-primary logout_woospca_btn" value="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" style="color:#<?php echo filter_var( $woospca_d_t_c); ?>;background: #<?php echo filter_var($woospca_d_bg_c); ?>;border-radius: 4px;padding: 4px 6px 4px 6px;">Logout <i class="fas fa-sign-out-alt"></i>
											</button>
										</center>
										<?php
									}
									?>
								</li>
							
							<?php

							foreach ($woospca_all_endpoints_withgrp as $key => $value) {

								if (isset($woospca_iiii) && 'orders' == $value->woospca_slug) {
									$namee=$value->woospca_name . ' (View Mode)';
								} else if ( isset($_GET['e']) && 'edit-address' == $value->woospca_slug ) {
									$namee=$value->woospca_name . ' (Edit Mode)';
								} else {
									$namee=$value->woospca_name;
								}												
								?>
								<li  role="presentation"
								<?php 
								if ('111' == $value->woospca_is_hide ) {
									echo filter_var('style="display:none;"');
									
								} else {
									echo filter_var('style="display: -webkit-inline-box;margin-left: 4px !important; width: fit-content !important;float: unset !important;"');
								}
								if ('link' == $value->woospca_type ) {
									echo filter_var('target="' . $value->woospca_new_tab . '"');
									echo filter_var( 'linktopage="' . $value->woospca_children . '"');
								} else if ('page' == $value->woospca_type) {
									echo filter_var('target="' . $value->woospca_new_tab . '"'); 
									echo filter_var( 'linktopage="' . get_permalink($value->woospca_children) . '"');
								} else if ('group' == $value->woospca_type) {
									echo filter_var('special="' . $value->woospca_id . '"'); 
								}
								if ('0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be'])) { 
									if ('group' == $value->woospca_type) {
										$activegroponload=true;

									} else {
										echo filter_var( 'class="active"');
									}
								} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
									echo filter_var( 'class="active"');
								} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
									echo filter_var( 'class="active"');
								} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
									echo filter_var( 'class="active"');
								} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
									echo filter_var( 'class="active"');
								} 
								?>
								>
								<?php

								if ('endpoint' == $value->woospca_type) {
									?>
									<a href="#Section<?php echo filter_var($value->woospca_slug); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?>
										
									</a>
									<?php

								} else if ('link' == $value->woospca_type) {
									?>
									<a href="<?php echo filter_var($value->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?>
										
									</a>
									<?php

								} else if ('page' == $value->woospca_type) {
									?>
									<a href="<?php echo filter_var(get_permalink($value->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?>
										
									</a>
									<?php
								} else if ('group'==$value->woospca_type) {
									?>
									<div class="dropdown">
										<a class="dropbtn dropbtn<?php echo filter_var($value->woospca_id); ?>" style="top: -18px !important;"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?>
											
										</a>
										<div style="top:67% !important;" class="dropdown-content animate__animated animate__fadeInDown">
											<?php
											foreach (unserialize($value->woospca_children) as $key_s => $value_s) {

												global $wpdb;
												$wpdb->woospca_custom_endpoints = $wpdb->prefix . 'woospca_custom_endpoints';
												$woospca_result=$wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->woospca_custom_endpoints . ' WHERE woospca_id = %d', intval($value_s) ) );
												?>
												<?php
												if ('endpoint' == $woospca_result[0]->woospca_type) {
													?>
													<a href="#Section<?php echo filter_var($woospca_result[0]->woospca_slug); ?>" ><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?>
														
													</a>
													<?php

												} else if ('link' == $woospca_result[0]->woospca_type) {
													?>
													<a href="" linktopage="<?php echo filter_var($woospca_result[0]->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
													<?php

												} else if ('page' == $woospca_result[0]->woospca_type) {
													?>
													<a href="" linktopage="<?php echo filter_var(get_permalink($woospca_result[0]->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
													<?php
												}																

											}
											?>

										</div>
									</div>

									<?php
								}
								?>

							</li>
								<?php											
							}
							?>
					</ul>
				</td>

			</tr>
			<tr>
				<td style="width: 100%;vertical-align: top;">								

					<div class="tab-content tabs" style="margin-top: 15px !important;">
						<?php

						foreach ($woospca_all_endpoints_withgrp as $key => $value) {
							?>
							<div  role="tabpanel" id="Section<?php echo filter_var($value->woospca_slug); ?>" class="tab-pane fade in
								<?php 
								if ('111'==$value->woospca_is_hide) {
									echo filter_var('style="display:none;"');
								} 
								if ( '0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be']) ) {
									echo filter_var('active');
								} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
										echo filter_var( 'active');
								} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
											echo filter_var( 'active');
								} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
												echo filter_var( 'active');
								} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
													echo filter_var( 'active');
								} 
								?>
								" >
										<?php
										if ('1'==$value->woospca_default) {
											if ('dashboard' == $value->woospca_slug) {
												echo filter_var('<h1 class="hdngg_woospca">Dashboard</h1><hr>');
												if ('before' == $value->woospca_children) {
													echo filter_var($value->woospca_content);
													include 'dashboard_template.php';
												} else if ('override' == $value->woospca_children) {
													echo filter_var($value->woospca_content);

												} else {
													include 'dashboard_template.php';
													echo filter_var($value->woospca_content);
												}




											} else if ('edit-account' == $value->woospca_slug) {
												echo filter_var('<h1 class="hdngg_woospca">Account Details</h1><hr>');
												if ('before' == $value->woospca_children) {
													echo filter_var($value->woospca_content);
													include 'edit_account_template.php';
												} else if ('override' == $value->woospca_children) {
													echo filter_var($value->woospca_content);

												} else {
													include 'edit_account_template.php';
													echo filter_var($value->woospca_content);
												}

											} else if ('orders' == $value->woospca_slug) {
												if ( isset($woospca_iiii) ) {
													$order_id=$woospca_iiii;
													
													echo filter_var('<h1 class="hdngg_woospca">Orders</h1><hr>');
													include 'view_order.php';
												} else {
													echo filter_var('<h1 class="hdngg_woospca">Orders</h1><hr>');
													if ('before' == $value->woospca_children) {
																echo filter_var($value->woospca_content);
																include 'orders_template.php';
													} else if ('override' == $value->woospca_children) {
																		echo filter_var($value->woospca_content);

													} else {
																		include 'orders_template.php';
																		echo filter_var($value->woospca_content);
													}

												}													

											} else if ('downloads' == $value->woospca_slug) {
												echo filter_var('<h1 class="hdngg_woospca">Downloads</h1><hr>');
												if ('before' == $value->woospca_children) {
													echo filter_var($value->woospca_content);
													include 'downloads.php';
												} else if ('override' == $value->woospca_children) {
													echo filter_var($value->woospca_content);

												} else {
															include 'downloads.php';
															echo filter_var($value->woospca_content);
												}


											} else if ('edit-address' == $value->woospca_slug) {
												if ( isset($_GET['e']) ) {	
															echo filter_var('<h1 class="hdngg_woospca">Address</h1><hr>');													
															include 'form_edit_address.php';
												} else {
															echo filter_var('<h1 class="hdngg_woospca">Address</h1><hr>');
													if ('before' == $value->woospca_children) {
																echo filter_var($value->woospca_content);
																include 'edit_address.php';
													} else if ('override' == $value->woospca_children) {
																echo filter_var($value->woospca_content);

													} else {
																		include 'edit_address.php';
																		echo filter_var($value->woospca_content);
													}

												}													

											} 
										} else {												
													echo filter_var($value->woospca_content);										
										}
										?>
								</div>
										<?php
						}

						?>
						</div>
					</td>
				</tr>
		</table>
						<?php
					} else if ('rightside' == $woospca_menu_pos) {
						?>
		<table style="width: 100%;" id="my_table_for_front_woospca">
			<tr>
				<td style="width: 65%;vertical-align: top;">								

					<div class="tab-content tabs" >

						<?php
						
						$activegroponload=false;
						foreach ($woospca_all_endpoints_withgrp as $key => $value) {
							?>
							<div role="tabpanel" id="Section<?php echo filter_var( $value->woospca_slug); ?>" class="tab-pane fade in 
								<?php 
								if ('111'==$value->woospca_is_hide) {
									echo filter_var( 'style="display:none;"');
								} 
								if ( '0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be']) ) {
									echo filter_var( 'active');
								} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
										echo filter_var( 'active');
								} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
											echo filter_var( 'active');
								} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
												echo filter_var( 'active');
								} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
													echo filter_var( 'active');
								} 
								?>
												" >
												<?php
												if ('1'==$value->woospca_default) {
													if ('dashboard' == $value->woospca_slug) {
														echo filter_var( '<h1 class="hdngg_woospca">Dashboard</h1><hr>');
														if ('before' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);
															include 'dashboard_template.php';
														} else if ('override' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);

														} else {
															include 'dashboard_template.php';
															echo filter_var( $value->woospca_content);
														}




													} else if ('edit-account' == $value->woospca_slug) {
														echo filter_var( '<h1 class="hdngg_woospca">Account Details</h1><hr>');
														if ('before' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);
															include 'edit_account_template.php';
														} else if ('override' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);

														} else {
															include 'edit_account_template.php';
															echo filter_var( $value->woospca_content);
														}

													} else if ('orders' == $value->woospca_slug) {
														if ( isset($woospca_iiii) ) {
															$order_id=$woospca_iiii;
															
															echo filter_var( '<h1 class="hdngg_woospca">Orders</h1><hr>');
															include 'view_order.php';
														} else {
															echo filter_var( '<h1 class="hdngg_woospca">Orders</h1><hr>');
															if ('before' == $value->woospca_children) {
																echo filter_var( $value->woospca_content);
																include 'orders_template.php';
															} else if ('override' == $value->woospca_children) {
																echo filter_var( $value->woospca_content);

															} else {
																include 'orders_template.php';
																echo filter_var( $value->woospca_content);
															}

														}													

													} else if ('downloads' == $value->woospca_slug) {
														echo filter_var( '<h1 class="hdngg_woospca">Downloads</h1><hr>');
														if ('before' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);
															include 'downloads.php';
														} else if ('override' == $value->woospca_children) {
															echo filter_var( $value->woospca_content);

														} else {
															include 'downloads.php';
															echo filter_var( $value->woospca_content);
														}


													} else if ('edit-address' == $value->woospca_slug) {
														if ( isset($_GET['e']) ) {	
															echo filter_var( '<h1 class="hdngg_woospca">Address</h1><hr>');													
															include 'form_edit_address.php';
														} else {
															echo filter_var( '<h1 class="hdngg_woospca">Address</h1><hr>');
															if ('before' == $value->woospca_children) {
																echo filter_var( $value->woospca_content);
																include 'edit_address.php';
															} else if ('override' == $value->woospca_children) {
																echo filter_var( $value->woospca_content);

															} else {
																include 'edit_address.php';
																echo filter_var( $value->woospca_content);
															}

														}													

													}
												} else {												
													echo filter_var( $value->woospca_content);										
												}
												?>
											</div>
											<?php
						}
						
						?>
									</div>
								</td>
								<td style="width: 35%;vertical-align: top;">


									<ul class="nav nav-tabs plugify_nav" role="tablist" style="margin-top:unset !important;margin-left: 15px !important;">
										<center>
											<li style="width: auto;">
												<?php
												if ('true' == $woospca_is_avatar) {
													?>
													<div class="container123">

														<div class="avatar-upload">
															<?php
															if ('true' == $woospca_is_upload_avatar) {
																?>
																<div class="avatar-edit">
																	<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
																	<label for="imageUpload">
																		<i style="position:absolute;top:8px;left:10px;" class="fa fa-fw fa-pencil-square-o"></i>
																	</label>
																</div>
																<?php
															}
															?>


															<img  class="avatar-preview" id="imagePreview" src="<?php echo filter_var($current_user_profile_url); ?>">


														</div>
													</div>
													<?php
												}
												?>
												<center>
													<strong style="font-size: 18px;"><?php echo esc_attr($current_user_name); ?></strong>
												</center>
												<center>
													<span style="font-size: 13px;"><?php echo esc_attr($current_user_woospca->user_email); ?></span>
												</center>
												<?php
												if ('true' == $woospca_is_logout) {
													?>
													<center> 
														<button class="button-primary logout_woospca_btn" value="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" style="color:#<?php echo filter_var( $woospca_d_t_c); ?>;background: #<?php echo filter_var($woospca_d_bg_c); ?>;border-radius: 4px;padding: 4px 6px 4px 6px;">Logout <i class="fas fa-sign-out-alt"></i>
														</button>
													</center>
													<?php
												}
												?>
											</li>
										</center>
										<?php
										foreach ($woospca_all_endpoints_withgrp as $key => $value) {

											if (isset($woospca_iiii) && 'orders' == $value->woospca_slug) {
													$namee=$value->woospca_name . ' (View Mode)';
											} else if ( isset($_GET['e']) && 'edit-address' == $value->woospca_slug ) {
													$namee=$value->woospca_name . ' (Edit Mode)';
											} else {
													$namee=$value->woospca_name;
											}												
											?>
												<li role="presentation"
												<?php 
												if ('111' == $value->woospca_is_hide ) {
													echo filter_var('style="display:none;"');
												} 
												if ('link' == $value->woospca_type ) {
													echo filter_var('target="' . $value->woospca_new_tab . '"');
													echo filter_var( 'linktopage="' . $value->woospca_children . '"');
												} else if ('page' == $value->woospca_type) {
													echo filter_var('target="' . $value->woospca_new_tab . '"'); 
													echo filter_var( 'linktopage="' . get_permalink($value->woospca_children) . '"');
												} else if ('group' == $value->woospca_type) {
													echo filter_var('special="' . $value->woospca_id . '"'); 
												}
												if ('' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be'])) { 
													if ('group' == $value->woospca_type) {
														$activegroponload=true;

													} else {
														echo filter_var( 'class="active"');
													}
												} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
													echo filter_var( 'class="active"');
												} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
													echo filter_var( 'class="active"');
												} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
													echo filter_var( 'class="active"');
												} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
													echo filter_var( 'class="active"');
												} 
												?>
												>
												<?php

												if ('endpoint' == $value->woospca_type) {
													?>
													<a href="#Section<?php echo filter_var($value->woospca_slug); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
													<?php

												} else if ('link' == $value->woospca_type) {
													?>
													<a href="<?php echo filter_var($value->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
													<?php

												} else if ('page' == $value->woospca_type) {
													?>
													<a href="<?php echo filter_var(get_permalink($value->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
													<?php
												} else if ('group'==$value->woospca_type) {
													?>
													<div class="dropdown">
														<a class="dropbtn dropbtn<?php echo filter_var($value->woospca_id); ?>" ><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
														<div style="right: 100.50% !important;" class="dropdown-content animate__animated animate__fadeInRight">
															<?php
															foreach (unserialize($value->woospca_children) as $key_s => $value_s) {

																global $wpdb;
																$wpdb->woospca_custom_endpoints = $wpdb->prefix . 'woospca_custom_endpoints';
																$woospca_result=$wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->woospca_custom_endpoints . ' WHERE woospca_id = %d', intval($value_s) ) );
																?>
																<?php
																if ('endpoint' == $woospca_result[0]->woospca_type) {
																	?>
																<a href="#Section<?php echo filter_var($woospca_result[0]->woospca_slug); ?>" ><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
																	<?php

																} else if ('link' == $woospca_result[0]->woospca_type) {
																	?>
																<a href="" linktopage="<?php echo filter_var($woospca_result[0]->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
																	<?php

																} else if ('page' == $woospca_result[0]->woospca_type) {
																	?>
																	<a href="" linktopage="<?php echo filter_var(get_permalink($woospca_result[0]->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
																		<?php
																}																

															}
															?>

														</div>
													</div>

													<?php
												}
												?>

											</li>
											<?php											
										}
										?>
									</ul>
								</td>

							</tr>
						</table>
						<?php

					} else if ('leftside' == $woospca_menu_pos) {
						?>
						<table style="width: 100%;" id="my_table_for_front_woospca">
							<tr>
								<td style="width: 35%;vertical-align: top;">


									<ul class="nav nav-tabs plugify_nav" role="tablist" style="margin-top:unset !important;margin-left: unset;">
											<center>
											<li style="width: auto;">
												<?php
												if ('true' == $woospca_is_avatar) {
													?>
													<div class="container123">

														<div class="avatar-upload">
															<?php
															if ('true' == $woospca_is_upload_avatar) {
																?>
																<div class="avatar-edit">
																	<input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
																	<label for="imageUpload">
																		<i style="position:absolute;top:8px;left:10px;" class="fa fa-fw fa-pencil-square-o"></i>
																	</label>
																</div>
																<?php
															}
															?>


															<img  class="avatar-preview" id="imagePreview" src="<?php echo filter_var($current_user_profile_url); ?>">


														</div>
													</div>
													<?php
												}
												?>
												<center>
													<strong style="font-size: 18px;"><?php echo esc_attr($current_user_name); ?></strong>
												</center>
												<center>
													<span style="font-size: 13px;"><?php echo esc_attr($current_user_woospca->user_email); ?></span>
												</center>
												<?php
												if ('true' == $woospca_is_logout) {
													?>
													<center> 
														<button class="button-primary logout_woospca_btn" value="<?php echo esc_url( wc_logout_url( wc_get_page_permalink( 'myaccount' ) ) ); ?>" style="color:#<?php echo filter_var( $woospca_d_t_c); ?>;background: #<?php echo filter_var($woospca_d_bg_c); ?>;border-radius: 4px;padding: 4px 6px 4px 6px;">Logout <i class="fas fa-sign-out-alt"></i>
														</button>
													</center>
													<?php
												}
												?>
											</li>
										</center>
										<?php
											
										$activegroponload=false;
										foreach ($woospca_all_endpoints_withgrp as $key => $value) {

											if (isset($woospca_iiii) && 'orders' == $value->woospca_slug) {
												$namee=$value->woospca_name . ' (View Mode)';
											} else if ( isset($_GET['e']) && 'edit-address' == $value->woospca_slug ) {
												$namee=$value->woospca_name . ' (Edit Mode)';
											} else {
												$namee=$value->woospca_name;
											}												
											?>
												<li role="presentation"
											<?php 
											if ('111' == $value->woospca_is_hide ) {
												echo filter_var( 'style="display:none;"');
											} 
											if ('link' == $value->woospca_type ) {
												echo filter_var('target="' . $value->woospca_new_tab . '"');
												echo filter_var( 'linktopage="' . $value->woospca_children . '"');
											} else if ('page' == $value->woospca_type) {
												echo filter_var('target="' . $value->woospca_new_tab . '"'); 
												echo filter_var( 'linktopage="' . get_permalink($value->woospca_children) . '"');
											} else if ('group' == $value->woospca_type) {
												echo filter_var('special="' . $value->woospca_id . '"'); 
											}
											if ('0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be'])) { 
												if ('group' == $value->woospca_type) {
													$activegroponload=true;

												} else {
													echo filter_var( 'class="active"');
												}
											} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
												echo filter_var( 'class="active"');
											} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
												echo filter_var( 'class="active"');
											} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
												echo filter_var( 'class="active"');
											} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
												echo filter_var( 'class="active"');
											} 
											?>
												>
												<?php

												if ('endpoint' == $value->woospca_type) {
													?>
													<a href="#Section<?php echo filter_var($value->woospca_slug); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
													<?php

												} else if ('link' == $value->woospca_type) {
													?>
													<a href="<?php echo filter_var($value->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
													<?php

												} else if ('page' == $value->woospca_type) {
													?>
													<a href="<?php echo filter_var(get_permalink($value->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
													<?php
												} else if ('group'==$value->woospca_type) {
													?>
													<div class="dropdown">
														<a class="dropbtn dropbtn<?php echo filter_var($value->woospca_id); ?>" ><?php echo filter_var($namee . ' <i style="float:right;" class="fa fa-fw fa-' . $value->woospca_icon . '"></i>'); ?></a>
														<div style="left: 99.98% !important;" class="dropdown-content animate__animated animate__fadeInLeft">
															<?php
															foreach (unserialize($value->woospca_children) as $key_s => $value_s) {

																global $wpdb;
																$wpdb->woospca_custom_endpoints = $wpdb->prefix . 'woospca_custom_endpoints';
																$woospca_result=$wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->woospca_custom_endpoints . ' WHERE woospca_id = %d', intval($value_s) ) );
																?>
																<?php
																if ('endpoint' == $woospca_result[0]->woospca_type) {
																	?>
																	<a href="#Section<?php echo filter_var($woospca_result[0]->woospca_slug); ?>" ><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
																	<?php

																} else if ('link' == $woospca_result[0]->woospca_type) {
																	?>
																	<a href="" linktopage="<?php echo filter_var($woospca_result[0]->woospca_children); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
																	<?php

																} else if ('page' == $woospca_result[0]->woospca_type) {
																	?>
																	<a href="" linktopage="<?php echo filter_var(get_permalink($woospca_result[0]->woospca_children)); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo filter_var($woospca_result[0]->woospca_name . ' <i style="float:right;" class="fa fa-fw fa-' . $woospca_result[0]->woospca_icon . '"></i>'); ?></a>
																	<?php
																}																

															}
															?>

														</div>
													</div>

													<?php
												}
												?>

											</li>
											<?php											
										}
										?>
									</ul>
								</td>
												<td style="width: 65%;vertical-align: top;">								

													<div class="tab-content tabs" style="margin-left: 15px !important;">

														<?php
														foreach ($woospca_all_endpoints_withgrp as $key => $value) {
															?>
															<div role="tabpanel" id="Section<?php echo filter_var($value->woospca_slug); ?>" class="tab-pane fade in 
																<?php 
																if ('111'==$value->woospca_is_hide) {
																	echo filter_var( 'style="display:none;"');
																} 
																if ( '0' == $key && !isset($_GET['b']) && !isset($woospca_iiii) && !isset($_GET['e']) && !isset($_GET['be']) ) {
																	echo filter_var( 'active');
																} else if (isset($_GET['b']) &&'orders'==$value->woospca_slug) {
																	echo filter_var( 'active');
																} else if (isset($woospca_iiii) &&'orders'==$value->woospca_slug) {
																	echo filter_var( 'active');
																} else if (isset($_GET['e']) &&'edit-address'==$value->woospca_slug) {
																		echo filter_var( 'active');
																} else if (isset($_GET['be']) &&'edit-address'==$value->woospca_slug) {
																		echo filter_var( 'active');
																} 
																?>
																				" >
																				<?php
																				if ('1'==$value->woospca_default) {

																					if ('dashboard' == $value->woospca_slug) {
																						echo filter_var( '<h1 class="hdngg_woospca">Dashboard</h1><hr>');
																						if ('before' == $value->woospca_children) {
																							echo filter_var( $value->woospca_content);
																							include 'dashboard_template.php';
																						} else if ('override' == $value->woospca_children) {
																							echo filter_var( $value->woospca_content);

																						} else {
																							include 'dashboard_template.php';
																							echo filter_var( $value->woospca_content);
																						}




																					} else if ('edit-account' == $value->woospca_slug) {
																						echo filter_var( '<h1 class="hdngg_woospca">Account Details</h1><hr>');
																						if ('before' == $value->woospca_children) {
																							echo filter_var( $value->woospca_content);
																							include 'edit_account_template.php';
																						} else if ('override' == $value->woospca_children) {
																							echo filter_var( $value->woospca_content);

																						} else {
																							include 'edit_account_template.php';
																							echo filter_var( $value->woospca_content);
																						}

																					} else if ('orders' == $value->woospca_slug) {
																						if ( isset($woospca_iiii) ) {
																							$order_id=$woospca_iiii;
																							
																							echo filter_var( '<h1 class="hdngg_woospca">Orders</h1><hr>');
																							include 'view_order.php';
																						} else {
																							echo filter_var( '<h1 class="hdngg_woospca">Orders</h1><hr>');
																							if ('before' == $value->woospca_children) {
																								echo filter_var( $value->woospca_content);
																								include 'orders_template.php';
																							} else if ('override' == $value->woospca_children) {
																								echo filter_var( $value->woospca_content);

																							} else {
																								include 'orders_template.php';
																								echo filter_var( $value->woospca_content);
																							}

																						}													

																					} else if ('downloads' == $value->woospca_slug) {
																						echo filter_var( '<h1 class="hdngg_woospca">Downloads</h1><hr>');
																						if ('before' == $value->woospca_children) {
																							echo filter_var( $value->woospca_content);
																							include 'downloads.php';
																						} else if ('override' == $value->woospca_children) {
																							echo filter_var( $value->woospca_content);

																						} else {
																							include 'downloads.php';
																							echo filter_var( $value->woospca_content);
																						}


																					} else if ('edit-address' == $value->woospca_slug) {
																						if ( isset($_GET['e']) ) {	
																							echo filter_var( '<h1 class="hdngg_woospca">Address</h1><hr>');													
																							include 'form_edit_address.php';
																						} else {
																							echo filter_var( '<h1 class="hdngg_woospca">Address</h1><hr>');
																							if ('before' == $value->woospca_children) {
																								echo filter_var( $value->woospca_content);
																								include 'edit_address.php';
																							} else if ('override' == $value->woospca_children) {
																								echo filter_var( $value->woospca_content);

																							} else {
																								include 'edit_address.php';
																								echo filter_var( $value->woospca_content);
																							}

																						}													

																					} 
																				} else {												
																					echo filter_var( $value->woospca_content);										
																				}
																				?>
																			</div>
																			<?php
														}

														?>
																	</div>
																</td>
															</tr>
														</table>
														<?php
					}

				}
				?>
											</div>
										</div>
									</div>
								</div>
															<?php
															if (isset($_GET['e']) || isset($woospca_iiii) || isset($_GET['b']) || isset($_GET['be'])) {
																?>
																<script type="text/javascript">
																	let stateObj = { id: "100" };

																	window.history.pushState(stateObj,
																		"Page 2", "<?php echo filter_var(wc_get_page_permalink( 'myaccount' )); ?>");

																	</script>
																	<?php
															}

															?>
																<script type="text/javascript">
																	if (true=='<?php echo filter_var($activegroponload); ?>') {

																		var thiss=jQuery('#my_table_for_front_woospca').find('.dropdown-content').find('a');
																		jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).css('background','#<?php echo filter_var($woospca_a_bg_c2); ?>');

																		jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).css('color','#<?php echo filter_var($woospca_a_t_c2); ?>');
																		jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).css('box-shadow','1px 2px 8px 1px #<?php echo filter_var($woospca_a_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_a_brdrandcorner_c2); ?>');
																		jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).css('border','1px solid #<?php echo filter_var($woospca_a_brdrandcorner_c2bb); ?>');


												// jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).css('background','#FFF');

												// jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).css('color','#384d48');
												jQuery('.dropbtn'+thiss.parent().parent().parent().attr('special')).click();
												var tobeclickedcontent=jQuery('.dropdown-content').find('a').attr('href');
												jQuery(tobeclickedcontent).addClass('active');
												jQuery(tobeclickedcontent).removeClass('fade');

											}
											jQuery('#my_table_for_front_woospca').find('li').on('click', function(){
												if (jQuery(window).width() < 700){
													jQuery('html, body').animate({
														scrollTop: jQuery('.tab-content').offset().top
													}, 700);
												}

												if (jQuery(this).attr('linktopage')){
													if(jQuery(this).attr('target')=='111'){
														window.open(jQuery(this).attr('linktopage'),'_blank')
													}else {
														window.location.assign(jQuery(this).attr('linktopage'))
													}

												}
											});
											jQuery('#my_table_for_front_woospca').find('li').on('click',function(){
												if(!jQuery(this).attr('special')) {

													jQuery('.dropbtn').css('background','#<?php echo filter_var($woospca_d_bg_c2); ?>');

													jQuery('.dropbtn').css('color','#<?php echo filter_var($woospca_d_t_c2); ?>');
													jQuery('.dropbtn').css('box-shadow','1px 2px 8px 1px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>');


													jQuery('.dropbtn').css('border','1px solid #<?php echo filter_var($woospca_d_brdrandcorner_c2bb); ?>');

													
													
												}
											});
											jQuery('#my_table_for_front_woospca').find('.dropdown-content').find('a').on('click',function(){
												console.log('yes')
												jQuery('#my_table_for_front_woospca').find('li').each(function(){

													jQuery(this).removeClass('active');
												});
												jQuery('#my_table_for_front_woospca').find('.tab-pane').each(function(){

													jQuery(this).removeClass('active');
												});
												if (jQuery(this).attr('linktopage')){
													if(jQuery(this).attr('target')=='111'){
														window.open(jQuery(this).attr('linktopage'),'_blank')
													}else {
														window.location.assign(jQuery(this).attr('linktopage'))
													}

												}
												jQuery(jQuery(this).attr('href')).addClass('active');
												jQuery(jQuery(this).attr('href')).removeClass('fade');

												jQuery('.dropbtn').css('background','#<?php echo filter_var($woospca_d_bg_c2); ?>');
												jQuery('.dropbtn').css('color','#<?php echo filter_var($woospca_d_t_c2); ?>');
												jQuery('.dropbtn'+jQuery(this).parent().parent().parent().attr('special')).css('background','#<?php echo filter_var($woospca_a_bg_c2); ?>');

												jQuery('.dropbtn'+jQuery(this).parent().parent().parent().attr('special')).css('color','#<?php echo filter_var($woospca_a_t_c2); ?>');
												jQuery('.dropbtn'+jQuery(this).parent().parent().parent().attr('special')).css('box-shadow','1px 2px 8px 1px #<?php echo filter_var($woospca_a_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_a_brdrandcorner_c2); ?>');
												jQuery('.dropbtn'+jQuery(this).parent().parent().parent().attr('special')).css('border','1px solid #<?php echo filter_var($woospca_a_brdrandcorner_c2bb); ?>');
												
												jQuery('.dropbtn'+jQuery(this).parent().parent().parent().attr('special')).click();

											});

										</script>
										<style type="text/css">
											
											.dropbtn {

												border-radius: <?php echo filter_var($woospca_brdr_rdiis); ?>px !important;
												/*background-color: #4CAF50;*/
												background: #<?php echo filter_var($woospca_d_bg_c2); ?>;
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>;
												color: #<?php echo filter_var($woospca_d_t_c2); ?>;
												padding: 16px;
												font-size: 16px;
												border: 1px solid #<?php echo filter_var($woospca_d_brdrandcorner_c2bb); ?>;
												cursor: pointer;
												text-decoration: none !important;
												padding: 10px 20px;
											
											}

											.dropdown {
												position: relative;
												display: grid;
											}

											.dropdown-content {
												display: none;
												position: absolute;
												background-color: #f9f9f9;
												width: 100%;

												
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>;
												z-index: 1;
											}

											.dropdown-content a {
												background: #<?php echo filter_var($woospca_d_bg_c2); ?>;
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>;
												color: #<?php echo filter_var($woospca_d_t_c2); ?>;
												padding: 12px 16px;
												text-decoration: none !important;
												display: block;
												border: 1px solid #<?php echo filter_var($woospca_d_brdrandcorner_c2bb); ?>;
											}

											.dropdown-content a:hover {background-color: #<?php echo filter_var($woospca_h_bg_c2); ?>;
												color: #<?php echo filter_var($woospca_h_t_c2); ?>;
												border: 1px solid #<?php echo filter_var($woospca_h_brdrandcorner_c2bb); ?>;
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_h_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_h_brdrandcorner_c2); ?>;}

											.dropdown:hover .dropdown-content {
												display: block;

											}

											.dropdown:hover .dropbtn {
												/*background-color: #3e8e41;*/
											}

											/*yahasy 3*/
											.nav-tabs>li>a{
												margin: unset !important;
												background: #<?php echo filter_var($woospca_d_bg_c2); ?>;
												color: #<?php echo filter_var($woospca_d_t_c2); ?>;
												text-decoration: none !important;
												border: 1px solid #<?php echo filter_var($woospca_d_brdrandcorner_c2bb); ?> !important;
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_d_brdrandcorner_c2); ?> !important;
											}


											.nav-tabs>li.active>a:focus,.nav-tabs>li.active>a, .nav-tabs>li.active>a:hover{
												border: 1px solid #<?php echo filter_var($woospca_a_brdrandcorner_c2bb); ?> !important;
												background: #<?php echo filter_var($woospca_a_bg_c2); ?> !important;
												color: #<?php echo filter_var($woospca_a_t_c2); ?> !important;
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_a_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_a_brdrandcorner_c2); ?> !important;

											}
											.nav-tabs>li>a:hover{
												border: 1px solid #<?php echo filter_var($woospca_h_brdrandcorner_c2bb); ?> !important;
												color: #<?php echo filter_var($woospca_h_t_c2); ?> !important;
												background-color: #<?php echo filter_var($woospca_h_bg_c2); ?> !important;
												box-shadow: 1px 2px 8px 1px #<?php echo filter_var($woospca_h_brdrandcorner_c2); ?>, 1px 2px 4px 0px #<?php echo filter_var($woospca_h_brdrandcorner_c2); ?> !important;
											}

										/*.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover{
											border:unset !important;
										}*/
											#my_table_for_front_woospca ul{
												display: grid;
											}
											#my_table_for_front_woospca li>a{
												border-radius: <?php echo filter_var($woospca_brdr_rdiis); ?>px !important;
											}
											#my_table_for_front_woospca li{

												border: unset !important;
												
												margin: <?php echo filter_var($woospca_p_t . 'px ' . $woospca_p_r . 'px ' . $woospca_p_b . 'px ' . $woospca_p_l . 'px '); ?> !important;
											}

											.container123 {
												margin: 3%;
												max-width: 150px;
												
											}



											.avatar-upload {
												position: relative;
												
												
											}
											.avatar-edit {
												position: absolute;
												left: 130px;
												z-index: 1;
												top: 130px;

											}
											.avatar-upload .avatar-edit input{
												display: none;
											}
											.avatar-upload .avatar-edit input + label{
												display: inline-block;
												width: 34px;
												height: 34px;
												margin-bottom: 0;
												border-radius: 100%;
												background: #FFFFFF;
												border: 1px solid transparent;
												box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
												cursor: pointer;
												font-weight: normal;
												transition: all 0.2s ease-in-out
											}
											.avatar-upload .avatar-edit input + label:after {

												color: #757575;
												position: absolute;
												top: 10px;
												left: 0;
												right: 0;
												text-align: center;
												margin: auto;
											}
											.avatar-preview {
												width: 150px;
												height: 150px;
												position: relative;
												border-radius: <?php echo filter_var($woospca_avatar_radius); ?>px;
												border: 3px solid #F8F8F8;
												box-shadow:1px 2px 7px 4px rgba(0, 0, 0, 0.2), 1px 2px 4px 0px rgba(0, 0, 0, 0.29)

											}
										}
										.hdngg_woospca{
											font-size: 26px !important;
											font-weight: 600 !important;
										}
									</style>

