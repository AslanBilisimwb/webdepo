CREATE TABLE `tsm_admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(35) NOT NULL,
  `email` varchar(99) NOT NULL,
  `password` varchar(99) NOT NULL,
  `password_recover` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tsm_admins` (`id`, `fname`, `email`, `password`, `password_recover`, `active`) VALUES
(1, 'Admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 1, 1);

CREATE TABLE `tsm_banks` (
  `id` int(11) NOT NULL,
  `title` varchar(80) NOT NULL,
  `content` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tsm_banks` (`id`, `title`, `content`, `active`) VALUES
(1, 'GARANTİ BANKASI', 'HESAP SAHİBİ : XXXXXXXX XXXXXXX <br> IBAN : TR XX XXXX XXXX XXXX XXXX XXXX XX', 1),
(2, 'ZİRAAT BANKASI', 'HESAP SAHİBİ : XXXXXXXX XXXXXXX <br> IBAN : TR XX XXXX XXXX XXXX XXXX XXXX XX', 1),
(3, 'PAPARA', 'PAPARA NO : 1234567890', 1);

CREATE TABLE `tsm_categories` (
  `id` int(3) NOT NULL,
  `name` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tsm_categories` (`id`, `name`, `active`) VALUES
(1, 'Scriptler', 1),
(2, 'Temalar', 1),
(3, 'Eklentiler', 1),
(4, 'WebSiteleri', 1);

CREATE TABLE `tsm_coupons` (
  `id` int(11) NOT NULL,
  `code` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `off` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `off_type` int(11) NOT NULL,
  `order_min` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tsm_coupons` (`id`, `code`, `off`, `off_type`, `order_min`, `active`) VALUES
(1, 'FREE20', '2.00', 2, 20, 1);

CREATE TABLE `tsm_custompages` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `indate` date NOT NULL,
  `level` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `tsm_custompages` (`id`, `title`, `content`, `indate`, `level`, `active`) VALUES
(1, 'Kullanım Şartları', 'Admin panelden düzenleyiniz', '2019-08-26', 0, 1),
(2, 'Gizlilik Sözleşmesi', 'Admin panelden düzenleyiniz', '2019-08-26', 0, 1),
(3, 'Lisanslar', 'Admin panelden düzenleyiniz', '2019-08-26', 0, 1);

CREATE TABLE `tsm_faqs` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tsm_faqs` (`id`, `title`, `content`, `active`) VALUES
(1, 'Scripti nasıl satın alabilirim?', 'Giriş yaptıktan sonra Kredi kartı ile güvenli shopier ödemesi aracılığıyla bakiye yükleyerek yada direk alım yapabilirsiniz.', 1),
(2, 'Scripti nasıl indirebilirim?', 'Scripti aldıktan sonra direk panelinizdeki indirme linkine yönlendirileceksiniz.', 1);

CREATE TABLE `tsm_news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `active` int(11) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tsm_news` (`id`, `title`, `content`, `date`, `active`, `author`) VALUES
(1, 'Script Marketime hoş geldiniz', 'Script Marketim yayın hayatına başlamıştır', '2019-10-15 14:20:00', 1, 'Admin'),
(2, 'Shopier direk ödeme entegrasyonu yapıldı', 'Bu güncelleme ile artık shopier üzerinden güvenli ve direk ödeme yapılabilmektedir. Artık bakiye yüklenmesini yada ürün alımının onaylanmasını beklemek yok. Satın alındığında bakiyeniz otomatik olarak yüklenmekte yada ürün alımınız anında onaylanmaktadır', '2019-10-15 14:29:13', 1, 'Admin');

CREATE TABLE `tsm_products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `short_des` varchar(200) DEFAULT NULL,
  `description` text NOT NULL,
  `icon_img` varchar(100) DEFAULT NULL,
  `preview_img` varchar(255) DEFAULT NULL,
  `file` varchar(100) DEFAULT NULL,
  `sales` int(11) NOT NULL DEFAULT '0',
  `support` int(11) NOT NULL DEFAULT '0',
  `demo` varchar(255) DEFAULT NULL,
  `featured` int(11) NOT NULL DEFAULT '0',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `views` int(11) NOT NULL DEFAULT '0',
  `dlname` varchar(255) DEFAULT NULL,
  `cat_id` int(3) NOT NULL DEFAULT '0',
  `subc_id` int(11) NOT NULL DEFAULT '0',
  `approved` int(11) NOT NULL DEFAULT '0',
  `stock_on` int(11) NOT NULL DEFAULT '0',
  `stock` int(11) NOT NULL DEFAULT '0',
  `views_off` int(11) NOT NULL DEFAULT '0',
  `reviews_off` int(11) NOT NULL DEFAULT '0',
  `downloadlim_on` int(11) DEFAULT NULL,
  `free` int(11) NOT NULL DEFAULT '0',
  `free_ins` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tsm_questions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `question` varchar(255) NOT NULL,
  `qdate` varchar(10) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `adate` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tsm_reviews` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `review` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tsm_sales` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `downloaded` int(11) NOT NULL DEFAULT '0',
  `downloadrem` int(11) DEFAULT NULL,
  `coupon` varchar(10) DEFAULT NULL,
  `method` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tsm_settings` (
  `setting` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tsm_settings` (`setting`, `value`) VALUES
('currency', 'TRY'),
('currency_sym', '₺'),
('homepage_header', 'Script Matketim'),
('homepage_subheader', 'Script, Kod, Tema Marketi'),
('site_favicon', '1567893984favicon.png'),
('site_logo', '1569765368logo.png'),
('site_name', 'ScriptMarketim - Script, Kod, Tema Marketi'),
('support_email', 'info@xxxxxxxxxxxxx.com'),
('theme', 'primary'),
('txn', '0'),
('global_message', ''),
('alert_type', 'info'),
('show_card_sde', '1'),
('smtp_auth', 'true'),
('smtp_secure', 'ssl'),
('smtp_host', 'mail.xxxxxxxxxxxxx.com'),
('smtp_port', '465'),
('smtp_user', 'info@xxxxxxxxxxxxx.com'),
('smtp_pass', 'xxxxxxxxxxxxx'),
('re_sitekey', 'xxxxxxxxxxxxxxxxxxx'),
('re_securekey', 'xxxxxxxxxxxxxxxxxxxx'),
('facebook', 'https://facebook.com/xxxxxxxxxxxx'),
('twitter', 'https://twitter.com/xxxxxxxxxxxx'),
('instagram', 'https://instagram.com/xxxxxxxxxxxxx'),
('googlep', 'https://googleplus.com/xxxxxxxxxxxxx'),
('linkedin', 'https://linked.in/xxxxxxxxxxxxx'),
('value1', '1'),
('value2', '50'),
('value3', '100'),
('value4', '250'),
('value5', '500'),
('value6', '1000'),
('apiuser', 'xxxxxxxxxxxxxxxxxxx'),
('apipass', 'xxxxxxxxxxxxxxxxxxx');

CREATE TABLE `tsm_subcat` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `tsm_subcat` (`id`, `cat_id`, `name`, `active`) VALUES
(1, 1, 'PHP Scriptler', 1),
(2, 1, 'Java Scriptler', 1),
(3, 1, 'Diğer Scriptler', 1),
(4, 2, 'WordPress Temalar', 1),
(5, 2, 'Joomla Temalar', 1),
(6, 2, 'Drupal Temalar', 1),
(7, 2, 'OpenCart Temalar', 1),
(8, 2, 'PrestaShop Temalar', 1),
(9, 2, 'HTML Temalar', 1),
(10, 2, 'Diğer Temalar', 1),
(11, 3, 'WordPress Eklentiler', 1),
(12, 3, 'Joomla Eklentiler', 1),
(13, 3, 'OpenCart Eklentiler', 1),
(14, 3, 'Diğer Eklentiler', 1),
(15, 4, 'Satılık WebSiteleri', 1),
(16, 4, 'Satılık Domainler', 1);

CREATE TABLE `tsm_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `product` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `callback` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tsm_users` (
  `id` int(11) NOT NULL,
  `fname` varchar(99) NOT NULL,
  `lname` varchar(99) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(99) NOT NULL,
  `gsm` varchar(15) NOT NULL,
  `address` varchar(150) NOT NULL,
  `city` varchar(15) NOT NULL,
  `postcode` varchar(6) NOT NULL,
  `password` varchar(99) NOT NULL,
  `purchases` int(11) NOT NULL,
  `balance` varchar(11) DEFAULT NULL,
  `verified` int(11) NOT NULL,
  `allow_email` int(11) NOT NULL,
  `password_recover` int(1) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `moderator` int(11) NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `tsm_wishlists` (
  `w_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `tsm_admins`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tsm_banks`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `tsm_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tsm_coupons`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tsm_custompages`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tsm_faqs`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `tsm_news`
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `tsm_products`
  ADD PRIMARY KEY (`id`);
  
ALTER TABLE `tsm_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `tsm_reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

ALTER TABLE `tsm_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `used_id` (`user_id`);

ALTER TABLE `tsm_settings`
  ADD UNIQUE KEY `setting_2` (`setting`),
  ADD KEY `setting` (`setting`);

ALTER TABLE `tsm_subcat`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tsm_transactions`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tsm_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`email`);

ALTER TABLE `tsm_wishlists`
  ADD PRIMARY KEY (`w_id`);

ALTER TABLE `tsm_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
  
ALTER TABLE `tsm_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tsm_categories`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `tsm_coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `tsm_custompages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `tsm_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tsm_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `tsm_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `tsm_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsm_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsm_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsm_subcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

ALTER TABLE `tsm_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `tsm_wishlists`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT;
