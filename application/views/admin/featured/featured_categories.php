<section class="wrapper">
    <div class="row">
        <div class="col-lg-12 main-chart">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo base_url(ADMIN_PREFIX); ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Popular Categories</li>
            </ol>

            <?php
            if($this->session->flashdata('flash_message'))
            {
            ?>
                <div class="alert alert-success">
                    <p class="text-center"><?php echo $this->session->flashdata('flash_message'); ?></p>
                </div>
            <?php
            }

            if($this->session->flashdata('flash_error'))
            {
            ?>
                <div class="alert alert-danger">
                    <p class="text-center"><?php echo $this->session->flashdata('flash_error'); ?></p>
                </div>
            <?php
            }
            ?>

            <div class="content_title">
                <h2><small>Popular Categories</small></h2>
            </div>
            <div class="frntnd_mnubg">
                <div class="col-md-6 remove_menu_from_list">
                    <form method="POST" action="<?php echo base_url(ADMIN_PREFIX . '/featured/update_featured_cats'); ?>">
                        <button class="btn btn-danger" type="submit">Remove From Popular</button>
                        <ul>
                        <?php
                        if (sizeof($featured_cats) > 0)
                        {
                            foreach ($featured_cats as $keyFC => $valueFC)
                            {
                        ?>
                            <li>
                                <input type="checkbox" class="menu-cat" id="<?php echo $valueFC['id']; ?>" name="remove_category[]" value="<?php echo $valueFC['id']; ?>">
                                <label for="<?php echo $valueFC['id']; ?>"><span><?php echo $keyFC+1; ?>.&nbsp;</span><?php echo $valueFC['store_category_name']; ?></label>
                            </li>
                        <?php
                            }
                        }
                        else
                        {
                        ?>
                            <li><i>-- No popular categories added yet. --</i></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </form>
                </div>

                <div class="col-md-6 box_shadow_div add_menu_in_list">
                    <form method="POST" action="<?php echo base_url(ADMIN_PREFIX . '/featured/update_featured_cats'); ?>">
                        <button class="btn btn-success" type="submit">Add To Popular</button>
                        <ul>
                        <?php
                        if (sizeof($all_records) > 0)
                        {
                            foreach ($all_records as $keyAR => $valueAR)
                            {
                        ?>
                                <li>
                                    <input type="checkbox" class="menu-cat" id="<?php echo $valueAR['id']; ?>" name="add_category[]" value="<?php echo $valueAR['id']; ?>">
                                    <label for="<?php echo $valueAR['id']; ?>"><span><?php echo $keyAR+1; ?>.&nbsp;</span><?php echo $valueAR['store_category_name']; ?></label>
                                </li>
                        <?php
                            }
                        }
                        else
                        {
                        ?>
                            <li><i>-- No categories added yet. --</i></li>
                        <?php
                        }
                        ?>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>