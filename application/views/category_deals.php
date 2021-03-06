<link rel="stylesheet" type="text/css" href="<?php echo plugin_url() . 'rateyo' . DS . 'jquery.rateyo.min.css'?>">
<script type="text/javascript" src="<?php echo plugin_url() . 'rateyo' . DS . 'jquery.rateyo.min.js'; ?>"></script>

<div class="row">
	<section class="cat_coupons_wrapper">
		<div class="container">
			<?php
			if ($this->uri->segment(1) == 'category')
			{
			?>
				<div class="heading_text_wrap">
					<h2><?php echo $category_name; ?></h2>
				</div>
			<?php
			}
			?>

			<div class="row">
				<div class="section_main">
					<div class="col-sm-3 col-md-2 left-pane">
						<div class="filters_header text-center">
							<h4>Filters
								<a class="pull-right filter_toggle visible-xs" href="javascript:void(0);"><i class="fa fa-filter"></i></a>
							</h4>
						</div>

						<div class="filter_inner_wrap">
							<div class="selected_filters_div"></div>
							<form action="<?php echo base_url() . 'deals'; ?>" id="deal_search_form">
								<div class="filter_btns_div">
									<input type="hidden" name="search_src" value="search_pg">
									<input type="hidden" class="form-control" name="cat_name" value="<?php echo isset($_GET['cat_name']) ? $_GET['cat_name'] : ''; ?>">
									&nbsp;<button type="button" class="btn default_btn" style="width: 46%;" onclick="clear_filters(this, 'all');">Clear All</button>
									<button class="btn green_btn text-center" style="width: 46%;">Apply</button>&nbsp;
									<hr>
								</div>

								<div class="filter_src_div">
									<h5 class="filter_heading">Source</h5>
									<ul class="filters-ul" id="src_filters_ul">
										<li>
											<input type="radio" name="src" value="local" <?php echo isset($_GET['src']) && $_GET['src'] == 'local' ? 'checked' : ''; ?>>&nbsp;
											<span>CouponZipcode</span>
										</li>
										<li>
											<input type="radio" name="src" value="restaurant_dot_com" <?php echo isset($_GET['src']) && $_GET['src'] == 'restaurant_dot_com' ? 'checked' : ''; ?>>&nbsp;
											<span>Restaurant.com</span>
										</li>
										<li>
											<input type="radio" name="src" value="groupon" <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'checked' : ''; ?>>&nbsp;
											<span>Groupon</span>
										</li>
										<li>
											<input type="radio" name="src" value="ebay" <?php echo isset($_GET['src']) && $_GET['src'] == 'ebay' ? 'checked' : ''; ?>>&nbsp;
											<span>Ebay</span>
										</li>
										<li>
											<input type="radio" name="src" value="amazon" <?php echo isset($_GET['src']) && $_GET['src'] == 'amazon' ? 'checked' : ''; ?>>&nbsp;
											<span>Amazon</span>
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_keyword_div <?php echo isset($_GET['src']) && $_GET['src'] == 'groupon' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										Search by Keyword
										<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
									</h5>
									<ul class="filters-ul filter-clearable">
										<li>
											<input type="text" class="form-control" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_range_div <?php echo isset($_GET['src']) && $_GET['src'] != 'groupon' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										Price Range (&#36;)
										<a href="javascript:void(0);" class="clear-filter" onclick="clear_filters(this);" style="opacity: 0">Clear</a>
									</h5>
									<small class="text-danger cat_require hide">Select at least 1 category</small>
									<ul class="filters-ul filter-clearable" id="range_filters_ul">
										<li>
											Min&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][0] : ''; ?>" class="form-control" name="price_range[]">
										</li>
										<li>
											Max&nbsp;<input min="0" type="number" value="<?php echo isset($_GET['price_range']) ? @$_GET['price_range'][1] : ''; ?>" class="form-control" name="price_range[]">
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_min_discount_div">
									<h5 class="filter_heading">
										Min. Discount
										<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['min_discount']) ? '' : 'hide'; ?>" onclick="clear_filters(this);">Clear</a>
									</h5>
									<small class="text-danger cat_require hide">Select at least 1 category</small>

									<ul class="filters-ul filter-clearable" id="min_discount_filters_ul">
										<li>
											<input type="radio" name="min_discount" value="10" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '10' ? 'checked' : ''; ?>>&nbsp;
											<span>10% and up</span>
										</li>
										<li>
											<input type="radio" name="min_discount" value="25" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '25' ? 'checked' : ''; ?>>&nbsp;
											<span>25% and up</span>
										</li>
										<li>
											<input type="radio" name="min_discount" value="35" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '35' ? 'checked' : ''; ?>>&nbsp;
											<span>35% and up</span>
										</li>
										<li>
											<input type="radio" name="min_discount" value="50" <?php echo isset($_GET['min_discount']) && $_GET['min_discount'] == '50' ? 'checked' : ''; ?>>&nbsp;
											<span>50% and up</span>
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_condition_div">
									<h5 class="filter_heading">
										Condition
										<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['condition']) ? '' : 'hide'; ?>" onclick="clear_filters(this);">Clear</a>
									</h5>
									<small class="text-danger cat_require hide">Select at least 1 category</small>
									
									<ul class="filters-ul filter-clearable" id="condition_filters_ul">
										<li>
											<input type="radio" name="condition" value="New" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'New' ? 'checked' : ''; ?>>&nbsp;
											<span>New</span>
										</li>
										<li>
											<input type="radio" name="condition" value="Used" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'Used' ? 'checked' : ''; ?>>&nbsp;
											<span>Used</span>
										</li>
										<li>
											<input type="radio" name="condition" value="Collectible" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'Collectible' ? 'checked' : ''; ?>>&nbsp;
											<span>Collectible</span>
										</li>
										<li>
											<input type="radio" name="condition" value="Refurbished" <?php echo isset($_GET['condition']) && $_GET['condition'] == 'Refurbished' ? 'checked' : ''; ?>>&nbsp;
											<span>Refurbished</span>
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_dt_div <?php echo isset($_GET['src']) && $_GET['src'] != 'local' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										Date Added
										<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['dt']) ? '' : 'hide'; ?>" onclick="clear_filters(this);">Clear</a>
									</h5>
									<ul class="filters-ul filter-clearable">
										<li>
											<input type="radio" name="dt" value="today" <?php echo isset($_GET['dt']) && $_GET['dt'] == 'today' ? 'checked' : ''; ?>>&nbsp;
											<span>Today</span>
										</li>
										<li>
											<input type="radio" name="dt" value="week" <?php echo isset($_GET['dt']) && $_GET['dt'] == 'week' ? 'checked' : ''; ?>>&nbsp;
											<span>This Week</span>
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_rvws_div <?php echo isset($_GET['src']) && $_GET['src'] != 'local' ? 'hide' : ''; ?>">
									<h5 class="filter_heading">
										CZ Rating
										<a href="javascript:void(0);" class="clear-filter <?php echo isset($_GET['rt']) ? '' : 'hide'; ?>" onclick="clear_filters(this);">Clear</a>
									</h5>
									<ul class="filters-ul filter-clearable">
										<li>
											<input type="radio" name="rt" value="5" <?php echo isset($_GET['rt']) && $_GET['rt'] == '5' ? 'checked' : ''; ?>>&nbsp;
											<span>
												<div class="review_rating_read" id="review_rating_5"></div>
											</span>
										</li>
										<li>
											<input type="radio" name="rt" value="4" <?php echo isset($_GET['rt']) && $_GET['rt'] == '4' ? 'checked' : ''; ?>>&nbsp;
											<span>
												<div class="review_rating_read" id="review_rating_4"></div>
											</span>
										</li>
										<li>
											<input type="radio" name="rt" value="3" <?php echo isset($_GET['rt']) && $_GET['rt'] == '3' ? 'checked' : ''; ?>>&nbsp;
											<span>
												<div class="review_rating_read" id="review_rating_3"></div>
											</span>
										</li>
									</ul>
									<hr>
								</div>

								<div class="filter_cat_div">
									<h5 class="filter_heading">Categories</h5>
									<?php
									foreach ($all_categories as $keyAC => $valueAC)
									{
									?>
										<ul class="filters-ul hide" id="<?php echo $keyAC . '_cat_ul'; ?>">
											<?php
											foreach ($valueAC as $keySub => $valueSub)
											{
												$cls_str = '';
												if ($keySub > 4)
												{
													$cls_str = 'hid_ul';
												}

												$src_cat_str = 'local-cat';
												$cat_val = $valueSub['store_category_slug'];
												if (isset($valueSub['category_source']))
												{
													if ($valueSub['category_source'] == CATEGORY_SRC_EBAY)
													{
														$src_cat_str = 'ebay-cat';
														$cat_val = $valueSub['category_uid'];
													}
													elseif ($valueSub['category_source'] == CATEGORY_SRC_GROUPON)
													{
														$src_cat_str = 'groupon-cat';
														$cat_val = $valueSub['store_category_slug'];
													}
													elseif ($valueSub['category_source'] == CATEGORY_SRC_AMAZON)
													{
														$src_cat_str = 'amazon-cat';
														$cat_val = $valueSub['store_category_slug'];
													}
												}
											?>
												<li class="<?php echo $cls_str; ?>" data-src="<?php echo $src_cat_str; ?>">
													<input type="checkbox" name="cat[]" value="<?php echo $cat_val; ?>" <?php echo isset($_GET['cat']) && in_array($cat_val, $_GET['cat']) ? 'checked' : ''; ?>>&nbsp;
													<span><?php echo $valueSub['store_category_name']; ?></span>
												</li>
											<?php
											}
											?>
										</ul>
									<?php
									}
									?>
									<hr>
								</div>
								
								<div class="filter_btns_div">
									&nbsp;<button type="button" class="btn default_btn" style="width: 46%;" onclick="clear_filters(this, 'all');">Clear All</button>
									<button class="btn green_btn text-center" style="width: 46%;">Apply</button>&nbsp;
								</div>

								<div class="form-inline sorting-div">
									<div class="sorting-div-inner">
										<div id="sorting_div_inner">
											<div class="form-group">
												<h4>Sort By</h4>
												<select class="form-control" name="sort_order">
													<option value="">--Select--</option>
													<option value="az" <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'az' ? 'selected' : ''; ?>>A-Z</option>
													<option value="za" <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'za' ? 'selected' : ''; ?>>Z-A</option>
													<!-- <option value="distance" <?php echo isset($_GET['sort_order']) && $_GET['sort_order'] == 'distance' ? 'selected' : ''; ?>>Distance</option> -->
												</select>
											</div>

											<div class="form-group">
												<h4>Within</h4>
												<select class="form-control" name="sort_distance">
													<option value="">--Select Distance--</option>
													<option value="1" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '1' ? 'selected' : ''; ?>>1 Mile</option>
													<option value="3" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '3' ? 'selected' : ''; ?>>3 Miles</option>
													<option value="5" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '5' ? 'selected' : ''; ?>>5 Miles</option>
													<option value="10" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '10' ? 'selected' : ''; ?>>10 Miles</option>
													<option value="15" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '15' ? 'selected' : ''; ?>>15 Miles</option>
													<option value="20" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '20' ? 'selected' : ''; ?>>20 Miles</option>
													<option value="25" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '25' ? 'selected' : ''; ?>>25 Miles</option>
													<option value="30" <?php echo isset($_GET['sort_distance']) && $_GET['sort_distance'] == '30' ? 'selected' : ''; ?>>30 Miles</option>
												</select>
											</div>

											<div class="form-group">
												<h4>of</h4>
												<input type="text" class="form-control cat-srch-zipcode" placeholder="Zipcode" value="<?php echo isset($_GET['store_zipcode']) ? get_zipcode_name($_GET['store_zipcode']) : ''; ?>">
												<input type="hidden" name="store_zipcode" class="store_zipcode_id_hidden" value="<?php echo isset($_GET['store_zipcode']) ? $_GET['store_zipcode'] : ''; ?>">
											</div>

											<div class="form-group">
												<input type="submit" name="sort_btn" class="btn ylew_btn" value="REFINE">
											</div>
										</div>

										<div id="sorting_inner_affiliate" class="text-center hide"></div>
									</div>
								</div>
							</form>
						</div>
					</div>

					<div class="col-sm-9 col-md-10 right-pane">
						<div class="exclusive_coupan cat_coupons">
							<div class="coupon_row_wrap">
							<?php
							if ($total_coupons_fetched > 0)
							{
								if (array_key_exists('local', $coupons))
								{
									foreach ($coupons['local'] as $keyCC => $valueCC)
									{
										$cpn_image = base_url($valueCC['store_image']);
										if ($valueCC['store_image'] == '' || is_null($valueCC['store_image']))
										{
											$cpn_image = base_url('assets/img/local-coupon-no-image.jpg');
										}
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a data-toggle="tooltip" title="<?php echo $valueCC['coupon_title']; ?>"  href="<?php echo base_url('coupon/') . $valueCC['id']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $cpn_image; ?>" alt="<?php echo $valueCC['coupon_title']; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3 title="<?php echo $valueCC['coupon_title']; ?>"><?php echo strlen($valueCC['coupon_title']) > 70 ? substr($valueCC['title'], 0, 70) . "..." : $valueCC['coupon_title']; ?></h3>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}
								elseif (array_key_exists('restaurant_dot_com', $coupons))
								{
									foreach ($coupons['restaurant_dot_com'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip" title="<?php echo $valueCC['name']; ?>" href="<?php echo $valueCC['buy-url']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<?php
														if (is_array($valueCC['image-url']))
														{
															echo img('restaurant-dot-com.png');
														}
														else
														{
															echo '<img src="' . $valueCC['image-url'] . '" alt="' . $valueCC['ad-id'] .'">';
														}
														?>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo $valueCC['name']; ?></h3>
															<p>&#36;<?php echo is_array($valueCC['sale-price']) ? $valueCC['price'] : $valueCC['sale-price']; ?></p>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}
								elseif (array_key_exists('groupon', $coupons))
								{
									foreach ($coupons['groupon'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip"  title="<?php echo $valueCC->title; ?>" href="<?php echo $valueCC->dealUrl; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC->grid4ImageUrl; ?>" alt="<?php echo $valueCC->shortAnnouncementTitle; ?>">
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo $valueCC->announcementTitle; ?></h3>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}
								elseif (array_key_exists('ebay', $coupons))
								{
									foreach ($coupons['ebay'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>"  href="<?php echo $valueCC['viewItemURL']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<?php
														if (array_key_exists('galleryURL', $valueCC))
														{
															echo '<img src="' . $valueCC['galleryURL'] . '" alt="' . $valueCC['itemId'] .'">';
														}
														else
														{
															echo img('ebay-dot-com.jpg');
														}
														?>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo strlen($valueCC['title']) > 70 ? substr($valueCC['title'], 0, 70) . "..." : $valueCC['title']; ?></h3>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}
								elseif (array_key_exists('amazon', $coupons))
								{
									foreach ($coupons['amazon'] as $keyCC => $valueCC)
									{
									?>
										<div class="col-xs-6 col-sm-6 col-md-4 cpn_adjst_img">
											<a target="_blank" data-toggle="tooltip" title="<?php echo $valueCC['title']; ?>" href="<?php echo $valueCC['url']; ?>">
												<div class="top_rstrnt_deal_wrap">
													<div class="cat_img_div">
														<img src="<?php echo $valueCC['largeImage'] == '' ? base_url('assets/img/amazon-dot-com.jpg') : $valueCC['largeImage']; ?>" alt="<?php echo $valueCC['asin']; ?>">
														<span><?php echo img('powered-by-amazon.jpg'); ?></span>
													</div>
													<div class="rstrnt_des_wrap">
														<div class="restrnt_desp_text_box">
															<h3><?php echo strlen($valueCC['title']) > 70 ? substr($valueCC['title'], 0, 70) . "..." : $valueCC['title']; ?></h3>
															<?php
															$price_str = 'Get Price NOW';
															if ($valueCC['rrp'] != 0.00)
															{
																if ($valueCC['lowestPrice'] < $valueCC['rrp'])
																{
																	$price_str = "<strike>&#36;" . $valueCC['rrp'] . "</strike>&nbsp;&#36;" . $valueCC['lowestPrice'];
																}
																else
																{
																	$price_str = "&#36;" . $valueCC['lowestPrice'];
																}
															}
															?>
															<p><?php echo $price_str; ?></p>
														</div>
													</div>
												</div>
											</a>
										</div>
									<?php
									}
								}
							}
							else
							{
							?>
								<div class="no-coupons-div">
									<div class="col-md-5 text-center">
										<?php echo img('oops.png', array('alt' => 'No coupons found')); ?>
									</div>

									<div class="col-md-7 rite-pane">
										<div>
											<h4>No products were found matching your selection.</h4>
											<p>Try a different keyword maybe?</p>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							</div>
						</div>
						
						<?php
						$pagination_setting = get_settings('deals_pagination');
						if ($total_coupons_fetched > 0 && $total_coupons_fetched >= $pagination_setting['limit'])
						{
						?>
							<div class="load-more-div">
								<button type="button" onclick="load_more(this);" id="load_more_btn" class="btn ylew_btn">Load More</button>
							</div>
						<?php
						}
						?>
					</div>
				</div>
			</div>
		</div>			
	</section>
</div>

<script>
$(document).ready(function()
{
	$('[data-toggle="tooltip"]').tooltip();

	$($('#src_filters_ul li input[type="radio"]')).on('click', function(e)
	{
		if (e.which == 1)
		{
			toggle_filters($(e.target));
		}
	});

	toggle_filters($('#src_filters_ul li input:checked'));

	$(document).on('click', $('.filter-clearable input'), function(e)
	{
		if (e.which == 1)
		{
			$(e.target).parents('.filter-clearable').siblings('.filter_heading').children('.clear-filter').removeClass('hide');
		}
	});

	$('.review_rating_read').each(function (index, value)
	{
		var target = "#" + $(value).attr('id');
		var rating = target.split('_');
		bind_rating(target, rating[rating.length-1]);
	});

	render_selected_filters();
});

function bind_rating(target, rating)
{
	$(target).rateYo({
		rating: rating,
		halfStar: true,
		readOnly: true,
		starWidth: "15px",
		multiColor: {"startColor": "#FF0000", "endColor"  : "#F39C12"},
	});

	$(target).css('display', 'inline-block');
}

function render_selected_filters()
{
	$(".filters-ul li input[type=checkbox]:checked").parent('li').children('span').html();
}

function toggle_filters(ele)
{
	var selected_src = $(".filters-ul").find($('input[name=src]:checked'));
	$('#sorting_inner_affiliate').html("<h4>" + selected_src.siblings('span').html() + "</h4>");
	
	$('.cat_require').addClass('hide');

	$('#sorting_inner_affiliate').addClass('hide');
	$('#sorting_div_inner').addClass('hide');
	$(".filter_range_div").addClass('hide');
	$(".filter_min_discount_div").addClass('hide');
	$(".filter_condition_div").addClass('hide');

	$('.filter_cat_div').removeClass('hide');
	$('.filter_cat_div ul').children('li').addClass('hide');
	$(".filter_cat_div .filters-ul").addClass('hide');
	$(".filter_cat_div .filters-ul li").addClass('hide');
	$('#' + selected_src.val() + '_cat_ul').removeClass('hide');
	$('.filter_cat_div ul li').children('input').removeAttr('name');

	if (selected_src.val() == 'local')
	{
		$('#sorting_div_inner').removeClass('hide');
		$('.filter_keyword_div').removeClass('hide');

		$('.filter_dt_div').removeClass('hide');
		$('.filter_dt_div').find('input[type=radio]').attr('name', $('.filter_dt_div').find('input[type=radio]').attr('data-name'));
		$('.filter_dt_div').find('input[type=radio]').removeAttr('data-name');

		$('.filter_rvws_div').removeClass('hide');
		$('.filter_rvws_div').find('input[type=radio]').attr('name', $('.filter_rvws_div').find('input[type=radio]').attr('data-name'));
		$('.filter_rvws_div').find('input[type=radio]').removeAttr('data-name');

		$('.filter_cat_div ul').children('li[data-src=local-cat]').removeClass('hide');
		$('.filter_cat_div ul li[data-src=local-cat]').children('input').attr('name', 'cat[]');
	}
	else
	{
		$('#sorting_inner_affiliate').removeClass('hide');

		if (selected_src.val() == 'restaurant_dot_com')
		{
			$('.filter_cat_div').addClass('hide');
			$('.filter_range_div').removeClass('hide');
			$('.filter_keyword_div').removeClass('hide');
			
			$('.filter_cat_div ul').children('li[data-src=amazon-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=amazon-cat]').children('input').attr('name', 'cat[]');
		}
		else if (selected_src.val() == 'groupon')
		{
			$('.filter_keyword_div').addClass('hide');

			$('.filter_cat_div ul').children('li[data-src=groupon-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=groupon-cat]').children('input').attr('name', 'cat[]');
		}
		else if (selected_src.val() == 'ebay')
		{
			$('.filter_range_div').removeClass('hide');
			$('.filter_keyword_div').removeClass('hide');

			$('.filter_cat_div ul').children('li[data-src=ebay-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=ebay-cat]').children('input').attr('name', 'cat[]');
		}
		else if (selected_src.val() == 'amazon')
		{
			$(".filter_range_div").removeClass('hide');
			$(".filter_min_discount_div").removeClass('hide');
			$(".filter_condition_div").removeClass('hide');

			$('.filter_cat_div ul').children('li[data-src=amazon-cat]').removeClass('hide');
			$('.filter_cat_div ul li[data-src=amazon-cat]').children('input').attr('name', 'cat[]');

			if ($('li[data-src=amazon-cat]').find($('input[name="cat[]"]:checked')).length == 0)
			{
				$('.cat_require').removeClass('hide');
			}
		}

		$('.filter_dt_div').addClass('hide');
		$('.filter_dt_div').find('input[type=radio]').attr('data-name', $('.filter_dt_div').find('input[type=radio]').attr('name'));
		$('.filter_dt_div').find('input[type=radio]').removeAttr('name');

		$('.filter_rvws_div').addClass('hide');
		$('.filter_rvws_div').find('input[type=radio]').attr('data-name', $('.filter_rvws_div').find('input[type=radio]').attr('name'));
		$('.filter_rvws_div').find('input[type=radio]').removeAttr('name');
	}

	$(".filter_cat_div .filters-ul").niceScroll({cursorborder:"", cursorcolor:"#1A5006"});
	$(".filter_cat_div .filters-ul").getNiceScroll().resize();
	$("body").getNiceScroll().resize();
}

function clear_filters(ele, target)
{
	if (typeof(target) == 'undefined')
	{
		$(ele).addClass('hide');
		$(ele).parent('.filter_heading').siblings('ul.filters-ul').find('input[type=text], input[type=number]').val('');
		$(ele).parent('.filter_heading').siblings('ul.filters-ul').find('input[type=checkbox]:checked, input[type=radio]:checked').prop('checked', false);
	}
	else if (target == 'all')
	{
		$('.clear-filter').each(function (index, value)
		{
			clear_filters(value);
		});
	}
}

var deals_page = 1;
function load_more(ele)
{
	deals_page = deals_page + 1;
	$.ajax({
		url: BASEURL + 'deals?' + $("#deal_search_form").serialize() + '&paginate[page]=' + deals_page + '&is_ajax=1',
		method: 'GET',
		dataType: 'json',
		beforeSend: function( xhr ) {
			$(ele).html('Loading...');
			$(ele).attr('disabled', 'disabled');
		},
		success: function(result)
		{
			$('.coupon_row_wrap').append(result);
			$("body").getNiceScroll().resize();
		},
		complete: function (jqXHR, status) {
			$(ele).html('Load More');
			$(ele).removeAttr('disabled');
		}
	});
}
</script>