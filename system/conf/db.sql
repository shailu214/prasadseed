
CREATE TABLE IF NOT EXISTS `tbl_admission_query` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(120) NOT NULL,
  `dob` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `remark` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_attendance_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `at_day` varchar(20) NOT NULL,
  `at_month` varchar(20) NOT NULL,
  `at_year` varchar(20) NOT NULL,
  `at_date` date NOT NULL,
  `login_time` varchar(50) NOT NULL,
  `logout_time` varchar(50) NOT NULL,
  `work_hour` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_attendance_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL,
  `at_day` varchar(20) NOT NULL,
  `at_month` varchar(20) NOT NULL,
  `at_year` varchar(20) NOT NULL,
  `at_date` varchar(50) NOT NULL,
  `login_time` varchar(50) NOT NULL,
  `logout_time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_batch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `batch_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_block_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codes` text NOT NULL,
  `msg` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_name` varchar(200) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `reg_fee` varchar(50) NOT NULL DEFAULT '0',
  `logo` varchar(200) NOT NULL,
  `sms_user` varchar(220) NOT NULL,
  `sms_pass` varchar(200) NOT NULL,
  `sender_id` varchar(200) NOT NULL,
  `mail_user` varchar(200) NOT NULL,
  `mail_pass` varchar(200) NOT NULL,
  `sms_fee_txt` text NOT NULL,
  `mail_fee_txt` text NOT NULL,
  `sms_abs_txt` text NOT NULL,
  `mail_abs_txt` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course` varchar(100) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `validity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `customer_name` varchar(60) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(250) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_custom_val` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `sval` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `name` varchar(80) NOT NULL,
  `ex_code` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `max_marks` varchar(100) NOT NULL,
  `divs` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_expences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` int(11) NOT NULL,
  `sbcat` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_fee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pay_id` int(11) NOT NULL DEFAULT '0',
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `month` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `fee` varchar(50) NOT NULL,
  `rfee` int(11) NOT NULL DEFAULT '0',
  `paid` varchar(50) NOT NULL,
  `discount` varchar(50) NOT NULL DEFAULT '0',
  `due` varchar(50) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_fee_reciept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '1',
  `code` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `month` varchar(50) NOT NULL,
  `f_year` varchar(160) DEFAULT NULL,
  `amount` varchar(50) NOT NULL,
  `other_fee` varchar(50) NOT NULL,
  `other_remark` varchar(250) NOT NULL,
  `disc` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `paid` varchar(50) NOT NULL,
  `due` varchar(50) NOT NULL,
  `rfee` int(11) NOT NULL DEFAULT '0',
  `rfee_amt` varchar(20) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_holiday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_day` varchar(10) NOT NULL,
  `h_month` varchar(10) NOT NULL,
  `h_year` varchar(10) NOT NULL,
  `h_date` date DEFAULT NULL,
  `caption` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `lv_month` int(11) NOT NULL,
  `lv_year` int(11) NOT NULL,
  `lv_days` varchar(250) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ex_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  `sub_name` varchar(120) NOT NULL,
  `marks` varchar(50) NOT NULL,
  `max_marks` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ex_id` (`ex_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(60) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `gst_amt` varchar(20) NOT NULL,
  `discount` varchar(120) NOT NULL,
  `total` varchar(120) NOT NULL,
  `paid` varchar(50) NOT NULL DEFAULT '0',
  `due` varchar(50) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_order_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `price` varchar(50) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `gst_amt` varchar(20) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `trx_type` int(11) NOT NULL DEFAULT '0',
  `mode` int(11) NOT NULL DEFAULT '0',
  `ord_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `desc` varchar(250) NOT NULL,
  `pay_desc` varchar(255) NOT NULL,
  `remark` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(200) NOT NULL,
  `hsn` varchar(20) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `price` varchar(100) NOT NULL,
  `sell_price` varchar(60) NOT NULL,
  `purchase_price` varchar(20) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `qty` varchar(100) NOT NULL DEFAULT '0',
  `pqty` varchar(100) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `vendor_id` varchar(60) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `gst_amt` varchar(50) NOT NULL,
  `total` varchar(50) NOT NULL,
  `paid` varchar(50) NOT NULL DEFAULT '0',
  `due` varchar(50) NOT NULL,
  `purchase_date` date NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_purchase_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `gst` varchar(20) NOT NULL,
  `gst_amt` varchar(50) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `total` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(150) NOT NULL,
  `amount` varchar(60) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `fname` varchar(60) NOT NULL,
  `lname` varchar(60) NOT NULL,
  `email` varchar(120) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `designation` varchar(60) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(150) NOT NULL,
  `fx_sallery` varchar(50) NOT NULL DEFAULT '0',
  `ph_sallery` varchar(50) NOT NULL DEFAULT '0',
  `work_hour` int(11) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_std_srv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `srv_id` int(11) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `srv_month` varchar(50) NOT NULL,
  `srv_year` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mobile2` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch` int(11) NOT NULL,
  `rfee` int(11) NOT NULL DEFAULT '0',
  `due` int(11) NOT NULL DEFAULT '0',
  `f_due` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `qr_img` varchar(200) DEFAULT NULL,
  `services` varchar(200) DEFAULT NULL,
  `prev_ids` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(150) NOT NULL,
  `marks` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_sub_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL DEFAULT '0',
  `category` varchar(120) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tax` varchar(50) NOT NULL,
  `val` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(120) NOT NULL,
  `lname` varchar(120) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `perm_opt` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
#
CREATE TABLE IF NOT EXISTS `tbl_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `vendor_name` varchar(50) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(120) NOT NULL,
  `address` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
