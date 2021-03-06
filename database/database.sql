-- -------------------------------------------------------------
-- TablePlus 3.8.0(336)
--
-- https://tableplus.com/
--
-- Database: database.sqlite
-- Generation Time: 2020-08-31 06:57:24.5770
-- -------------------------------------------------------------


INSERT INTO "about__contacts"
    ("id", "name", "email", "phone", "message", "created_at", "updated_at", "deleted_at")
VALUES
    ('1', 'ahmed', 'Fares@gmail.com', '022126546', 'nice website', '2020-08-16 17:06:05', '2020-08-16 17:06:05', NULL),
    ('2', 'dfsdfsdf', 'asdasd@gmail.com', '05024325465', 'aaaaaaaaaaaa', '2020-08-21 07:58:32', '2020-08-21 07:58:32', NULL),
    ('3', 'aaaa', 'ahmed@gmail.com', '0121011215', '1024534534865', '2020-08-27 10:17:23', '2020-08-27 10:17:23', NULL);

INSERT INTO "about__contacts__texts"
    ("id", "text_en", "text_ar", "created_at", "updated_at", "deleted_at")
VALUES
    ('1', 'Do you have any questions? Have a look at the categories below, and if these do not include the answer you were looking for, please feel free to shoot us an email.', 'هل لديك اسئلة؟ ألق نظرة على الفئات أدناه ، وإذا كانت لا تتضمن الإجابة التي كنت تبحث عنها ، فلا تتردد في مراسلتنا عبر البريد الإلكتروني.', '2020-08-16 17:02:32', '2020-08-16 17:02:32', NULL);

INSERT INTO "about_aretists"
    ("id", "name_en", "name_ar", "image_ar", "created_at", "updated_at", "deleted_at", "sociallink")
VALUES
    ('1', 'Edoardo Tresoldi', 'ادواردو ترسولدي', 'images/5f3f9a80d47db.jpg', '2020-08-16 17:05:24', '2020-08-21 07:57:20', NULL, 'https://www.instagram.com/dani'),
    ('2', 'Mohamed', 'محمد', 'images/5f3f9a895ddb7.jpg', '2020-08-16 17:05:35', '2020-08-21 07:57:29', NULL, 'https://www.instagram.com/edoa');

INSERT INTO "about_contents"
    ("id", "body1_en", "body1_ar", "body_image", "body2_en", "body2_ar", "created_at", "updated_at", "deleted_at")
VALUES
    ('1', 'You, like everyone else on this planet, were born a creative person with good intentions. Able to change the world in ways so much bigger than you probably can imagine right now. All the rules of society then programmed you to think and calculate yourself through life in a way that is useful and not disturbing anyone else. Conforming to this norm made you fit in, but also stripped you of your boundless childlike creativity, imagination and lust for exploration.\r\n\r\nRight now, what the world needs most, is people who find that version of themselves back again. People who come alive again. People who wonder, can be amazed and feel ecstatic like they did when they were little kids. Bringing you alive again, and reminding you of the version of yourself that can do anything, that is our.', 'أنت ، مثل أي شخص آخر على هذا الكوكب ، ولدت شخصًا مبدعًا بنوايا حسنة. قادر على تغيير العالم بطرق أكبر بكثير مما تتخيله الآن. ثم برمجتك جميع قواعد المجتمع على التفكير وحساب نفسك من خلال الحياة بطريقة مفيدة ولا تزعج أي شخص آخر. التوافق مع هذا المعيار جعلك مناسبًا ، ولكنه أيضًا جردك من إبداعك الطفولي اللامحدود وخيالك وشغفك بالاستكشاف. في الوقت الحالي ، أكثر ما يحتاجه العالم ، هو الأشخاص الذين يجدون هذه النسخة من أنفسهم تعود مرة أخرى. الناس الذين عادوا إلى الحياة مرة أخرى. الأشخاص الذين يتساءلون ، يمكن أن يندهشوا ويشعروا بالنشوة كما فعلوا عندما كانوا أطفالًا صغارًا. إن إحياءك للحياة مرة أخرى ، وتذكيرك بنسخة نفسك القادرة على فعل أي شيء ، هذه هي مهمتنا.', 'images/5f3f96c55429b.jpg', 'Behind every artwork we sell, there are ideas, visions, amazing artists and great stories. On this page we highlight some of that. If you want to learn more about an artwork you are about to buy, but the artist is not listed on this page, click on their name during shopping and you will get redirected straight to their most important social media account 123 .', 'وراء كل عمل فني نبيعه ، هناك أفكار ورؤى وفنانين رائعين وقصص رائعة. في هذه الصفحة نبرز بعضًا من ذلك. إذا كنت ترغب في معرفة المزيد حول عمل فني أنت على وشك شرائه ، ولكن الفنان غير مدرج في هذه الصفحة ، فانقر فوق اسمه أثناء التسوق وستتم إعادة توجيهك مباشرةً إلى حسابه أو موقعه على وسائل التواصل الاجتماعي الأكثر أهمية.', '2020-08-16 17:01:47', '2020-08-31 04:52:06', NULL);

INSERT INTO "appliedartists"
    ("id", "name", "email", "phone", "created_at", "updated_at", "deleted_at", "socialLink")
VALUES
    ('1', 'sdsd@gmail.com', 'hazem@gmail.com', '04121026', '2020-08-16 17:06:33', '2020-08-16 17:06:33', NULL, 'www.google.com'),
    ('2', 'aaaa', 'aaaaa@gmail.com', '010023565', '2020-08-21 07:58:10', '2020-08-21 07:58:10', NULL, 'www.facebook.com'),
    ('3', 'msdfnlkdfl', 'kwejlwk@gmail.com', '01242425', '2020-08-27 10:18:39', '2020-08-27 10:18:39', NULL, 'cairo@gmail.com');

INSERT INTO "artists"
    ("id", "name", "cover_img", "created_at", "updated_at")
VALUES
    ('1', 'images/5f3f95b3bc470.jpg', '2020-08-16 16:42:52', '2020-08-21 07:36:51'),
    ('2', 'images/5f3f95c69201a.jpg', '2020-08-16 16:43:24', '2020-08-21 07:37:10'),
    ('3', 'images/5f47a156c2c3f.jpg', '2020-08-27 10:04:38', '2020-08-27 10:04:38');

INSERT INTO "discounts"
    ("id", "code", "discount_percentage", "created_at", "updated_at", "deleted_at")
VALUES
    ('1', 'Fares10', '10', '2020-08-16 17:12:08', '2020-08-16 17:12:08', NULL);

INSERT INTO "home_datas"
    ("id", "word1_en", "word1_ar", "word2_en", "word2_ar", "word3_en", "word3_ar", "image", "video", "created_at", "updated_at", "deleted_at")
VALUES
    ('1', 'Live now', 'لايف الان', 'Fantastic new art', 'مكتبه فن جديدة', 'ccccccccccc', 'سسسسسسسسسسسس', 'images/5f3f96b7d7b50.jpg', 'videos/5f3f96b80c294.gif', '2020-08-16 16:40:12', '2020-08-21 07:41:12', NULL);

INSERT INTO "joinus__texts"
    ("id", "text_en", "text_ar", "created_at", "updated_at", "deleted_at")
VALUES
    ('1', 'You might already have a contact page live on your site. But does it have a contact form or just a company email address?', 'قد يكون لديك بالفعل صفحة اتصال موجودة على موقعك. ولكن هل يحتوي على نموذج اتصال أم مجرد عنوان بريد إلكتروني للشركة؟', '2020-08-16 17:05:00', '2020-08-16 17:05:00', NULL);


INSERT INTO "order_palettes"
    ("id", "order_id", "palatte_id", "size", "extrainfo", "price", "quantity", "deleted_at", "created_at", "updated_at")
VALUES
    ('1', '1', '1', 'medium', NULL, '100.0', '4', NULL, '2020-08-16 16:54:42', '2020-08-16 16:54:42'),
    ('2', '1', '5', 'medium', NULL, '300.0', '4', NULL, '2020-08-16 16:54:42', '2020-08-16 16:54:42'),
    ('3', '1', '3', 'medium', NULL, '300.0', '3', NULL, '2020-08-16 16:54:42', '2020-08-16 16:54:42'),
    ('4', '2', '6', 'medium', NULL, '600.0', '1', NULL, '2020-08-20 12:08:34', '2020-08-20 12:08:34'),
    ('5', '2', '1', 'medium', NULL, '100.0', '6', NULL, '2020-08-20 12:08:34', '2020-08-20 12:08:34'),
    ('6', '3', '2', 'medium', NULL, '200.0', '12', NULL, '2020-08-27 10:00:19', '2020-08-27 10:00:19');

INSERT INTO "orders"
    ("id", "email", "fname", "lname", "address", "apartment", "city", "postcode", "goverment", "country", "phone", "paymentid", "paymentstatus", "promocode", "discount", "totalprice", "payment_transaction_return", "created_at", "updated_at")
VALUES
    ('1', 'ahmed@gmail.com', 'ahmed', 'ali', '3 cairo misr', '3', 'cairo', '02002', 'Saudi Arabia', 'Egypt', '01025659596', 'E7F3A1335855BF38D3E44A058E5332C0.uat01-vm-tx03', 'pending', NULL, NULL, '2500', NULL, '2020-08-16 16:54:42', '2020-08-16 16:54:42'),
    ('2', 'jack@gmail.com', 'ahmed', 'hassan', '3 cairo', '3', 'cairo', '0200', 'Saudi Arabia', 'Saudi Arabia', '0102356566', '0BFB096DFE71E18F470DF1886F309B52.uat01-vm-tx02', 'pending', NULL, NULL, '1200', NULL, '2020-08-20 12:08:34', '2020-08-20 12:08:34'),
    ('3', 'ahmed@gmail.com', 'ahmed', 'ali', 'cairo', 'cairo', 'cairo', '022121', 'Saudi Arabia', 'Saudi Arabia', '1021124154515', 'C8EB1F25EE6B1BC88829810810935516.uat01-vm-tx02', 'pending', NULL, NULL, '2400', NULL, '2020-08-27 10:00:19', '2020-08-27 10:00:19');

INSERT INTO "paletteimages"
    ("id", "img", "palatte_id", "created_at", "updated_at", "deleted_at")
VALUES
    ('43', 'images/5f3f955710c26.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('44', 'images/5f3f95572ba38.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('45', 'images/5f3f955740c7c.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('46', 'images/5f3f9557562a7.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('47', 'images/5f3f95576d1dc.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('48', 'images/5f3f955781a1e.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('49', 'images/5f3f955796667.jpg', '1', '2020-08-21 07:35:19', '2020-08-21 07:35:19', NULL),
    ('50', 'images/5f3f958e16ee0.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('51', 'images/5f3f958e3483e.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('52', 'images/5f3f958e4a280.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('53', 'images/5f3f958e5e787.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('54', 'images/5f3f958e75fc2.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('55', 'images/5f3f958e8cd4b.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('56', 'images/5f3f958ea2963.jpg', '2', '2020-08-21 07:36:14', '2020-08-21 07:36:14', NULL),
    ('57', 'images/5f3f96073cbba.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('58', 'images/5f3f960754189.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('59', 'images/5f3f960766d95.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('60', 'images/5f3f96077ad63.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('61', 'images/5f3f96078f7b8.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('62', 'images/5f3f9607a25cf.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('63', 'images/5f3f9607b5ebd.jpg', '3', '2020-08-21 07:38:15', '2020-08-21 07:38:15', NULL),
    ('64', 'images/5f3f96385f03d.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('65', 'images/5f3f96387520f.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('66', 'images/5f3f963889080.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('67', 'images/5f3f96389b6b3.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('68', 'images/5f3f9638afa07.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('69', 'images/5f3f9638c319a.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('70', 'images/5f3f9638d5a20.jpg', '4', '2020-08-21 07:39:04', '2020-08-21 07:39:04', NULL),
    ('71', 'images/5f3f9670c2c26.jpg', '5', '2020-08-21 07:40:00', '2020-08-21 07:40:00', NULL),
    ('72', 'images/5f3f9670db5f1.jpg', '5', '2020-08-21 07:40:00', '2020-08-21 07:40:00', NULL),
    ('73', 'images/5f3f9670f0e3c.jpg', '5', '2020-08-21 07:40:01', '2020-08-21 07:40:01', NULL),
    ('74', 'images/5f3f967112e00.jpg', '5', '2020-08-21 07:40:01', '2020-08-21 07:40:01', NULL),
    ('75', 'images/5f3f967128f46.jpg', '5', '2020-08-21 07:40:01', '2020-08-21 07:40:01', NULL),
    ('76', 'images/5f3f96713c312.jpg', '5', '2020-08-21 07:40:01', '2020-08-21 07:40:01', NULL),
    ('77', 'images/5f3f96714f944.jpg', '5', '2020-08-21 07:40:01', '2020-08-21 07:40:01', NULL),
    ('78', 'images/5f3f96a1c0b0c.jpg', '6', '2020-08-21 07:40:49', '2020-08-21 07:40:49', NULL),
    ('79', 'images/5f3f96a1dbfc2.jpg', '6', '2020-08-21 07:40:49', '2020-08-21 07:40:49', NULL),
    ('80', 'images/5f3f96a200354.jpg', '6', '2020-08-21 07:40:50', '2020-08-21 07:40:50', NULL),
    ('81', 'images/5f3f96a21aec7.jpg', '6', '2020-08-21 07:40:50', '2020-08-21 07:40:50', NULL),
    ('82', 'images/5f3f96a2355a0.jpg', '6', '2020-08-21 07:40:50', '2020-08-21 07:40:50', NULL),
    ('83', 'images/5f3f96a24ecd3.jpg', '6', '2020-08-21 07:40:50', '2020-08-21 07:40:50', NULL),
    ('84', 'images/5f3f96a268320.jpg', '6', '2020-08-21 07:40:50', '2020-08-21 07:40:50', NULL),
    ('85', 'images/5f47a2cb5998a.jpg', '7', '2020-08-27 10:10:51', '2020-08-27 10:10:51', NULL),
    ('86', 'images/5f47a2cb72218.jpg', '7', '2020-08-27 10:10:51', '2020-08-27 10:10:51', NULL),
    ('87', 'images/5f47a2cb884fd.jpg', '7', '2020-08-27 10:10:51', '2020-08-27 10:10:51', NULL),
    ('88', 'images/5f47a2cb9cf5c.jpg', '7', '2020-08-27 10:10:51', '2020-08-27 10:10:51', NULL),
    ('89', 'images/5f47a2cbafcd8.jpg', '7', '2020-08-27 10:10:51', '2020-08-27 10:10:51', NULL),
    ('90', 'images/5f47a2cbc38b4.jpg', '7', '2020-08-27 10:10:51', '2020-08-27 10:10:51', NULL),
    ('91', 'images/5f4a129c96b4a.jpg', '8', '2020-08-29 08:32:28', '2020-08-29 08:32:28', NULL),
    ('92', 'images/5f4a129caaf9f.jpg', '8', '2020-08-29 08:32:28', '2020-08-29 08:32:28', NULL),
    ('93', 'images/5f4a129cbcc4c.jpg', '8', '2020-08-29 08:32:28', '2020-08-29 08:32:28', NULL),
    ('94', 'images/5f4a129cd7625.jpg', '8', '2020-08-29 08:32:28', '2020-08-29 08:32:28', NULL),
    ('95', 'images/5f4a129cf03a2.jpg', '8', '2020-08-29 08:32:29', '2020-08-29 08:32:29', NULL),
    ('96', 'images/5f4a129d11485.jpg', '8', '2020-08-29 08:32:29', '2020-08-29 08:32:29', NULL);

INSERT INTO "palettes"
    ("id", "name", "img", "palette_copies", "avalible_copies", "S_copies", "S_avalible", "S_price", "M_copies", "M_avalible", "M_price", "L_copies", "L_avalible", "L_price", "sizing_details", "print_material", "print_ink", "print_finish", "frame_material", "frame_finish", "artist_id", "created_at", "updated_at", "deleted_at", "addtocart", "sizing_details_ar", "print_material_ar", "print_ink_ar", "print_finish_ar", "frame_material_ar", "frame_finish_ar", "description", "description_ar", "shipping", "shipping_ar", "tag")
VALUES
    ('1', 'Full bom', 'images/5f3f9537eed4f.jpg', '20', '10', '5', '5', '50', '10', '0', '100', '5', '5', '200', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', 'Print material: 200gsm canvas Print ink.', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Marupa wood, neodynium magnets', 'Semi-gloss', '1', '2020-08-16 16:44:17', '2020-08-21 08:10:11', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'going fast'),
    ('2', 'Monarch', 'images/5f3f956ba846d.jpg', '30', '18', '5', '5', '50', '12', '0', '200', '13', '13', '500', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', 'Print material: 200gsm canvas Print ink.', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Marupa wood, neodynium magnets', 'Semi-gloss', '1', '2020-08-16 16:45:56', '2020-08-27 10:00:44', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'knitwork'),
    ('3', 'Forgotten', 'images/5f3f95e61d862.jpg', '10', '7', '1', '1', '150', '3', '0', '300', '6', '6', '600', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', 'Print material: 200gsm canvas Print ink.', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Marupa wood, neodynium magnets', 'Semi-gloss', '1', '2020-08-16 16:47:04', '2020-08-21 07:37:42', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'going fast'),
    ('4', 'Rocket', 'images/5f3f961607487.jpg', '60', '60', '20', '20', '200', '20', '20', '600', '20', '20', '800', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', 'Print material: 200gsm canvas Print ink.', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Marupa wood, neodynium magnets', 'Semi-gloss', '2', '2020-08-16 16:48:57', '2020-08-21 07:38:30', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ecstase originals'),
    ('5', 'swept', 'images/5f3f9651be2af.jpg', '40', '36', '20', '20', '200', '10', '6', '300', '10', '10', '600', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', 'Print material: 200gsm canvas Print ink.', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Marupa wood, neodynium magnets', 'Semi-gloss', '2', '2020-08-16 16:50:10', '2020-08-21 07:39:29', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'diamond dust'),
    ('6', 'Space', 'images/5f3f967ed5de7.jpg', '100', '99', '20', '20', '200', '15', '14', '600', '65', '65', '800', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', '200 gsm canvas Print ink.', '12-colour digital, archival ink', 'Matte', 'Marupa wood, neodynium magnets', 'Semi-gloss', '2', '2020-08-16 16:51:08', '2020-08-27 18:43:41', NULL, '1', 'كل عمل فني متوفر بثلاثة أحجام: 30 × 40 سم (12 × 16 بوصة) ، 50 × 66.5 سم (20 × 26 بوصة) و 70 × 93.5 سم (28 × 37 بوصة).', '٢٠٠ جرام', 'حبر أرشيفية رقمي 12 لونًا', 'مادة', 'خشب ماروبا ، مغناطيس نيودينيوم', 'شبه لامع', 'AR Walltones is the first artwork series in the world to come with its own augmented reality.

The print comes with an original Instagram filter that is activated by the artwork and creates a 3D augmented reality, bringing the artwork outside of the flat surface and creating an installation in your room.

You can find the filter here

This limited edition release is printed in bright, vivid colors on a thick piece of woven canvas. Each print contains a serial number guaranteeing its originality. Curated by Ecstase in a collaboration with Justin Estcourt for a limited edition of 250.

"An asteroid descends onto barren earth. Created with scratch board and white ink." - Justin Estcourt', 'AR Walltones هي أول سلسلة فنية في العالم تأتي بواقعها المعزز.

تأتي الطباعة مع مرشح Instagram الأصلي الذي يتم تنشيطه بواسطة العمل الفني ويخلق واقعًا معززًا ثلاثي الأبعاد ، مما يجعل العمل الفني خارج السطح المسطح وإنشاء تثبيت في غرفتك.

يمكنك العثور على الفلتر هنا

تمت طباعة هذا الإصدار المحدود بألوان زاهية وحيوية على قطعة سميكة من القماش المنسوج. تحتوي كل طبعة على رقم تسلسلي يضمن أصالتها. برعاية Ecstase بالتعاون مع Justin Estcourt لإصدار محدود من 250.

"كويكب ينزل على أرض قاحلة. مكون من لوحة خدش وحبر أبيض." - جاستن إستكورت', 'Please allow 9-12 days for your order to arrive.  Why so long?  Because a limited edition artwork is worth waiting for? Yes. But also because the environmental impact of worldwide shipping is enormous. Our customers are pretty equally distributed worldwide and ideally we would have a distribution centre on each continent. However, that would mean shipping the artworks twice. From the factory to the warehouse, and from the warehouse to the customer, resulting in higher CO2 emissions. Instead, we choose on-demand creation of artworks to minimise waste, and shipping to customers directly from the Ecstase factory to minimise our carbon footprint.', 'يُرجى الانتظار 9-12 يومًا حتى يصل طلبك.  لماذا كل هذا الوقت؟  لأن عمل فني محدود الإصدار يستحق الانتظار؟ نعم. ولكن أيضًا لأن التأثير البيئي للشحن في جميع أنحاء العالم هائل. يتم توزيع عملائنا بشكل متساوٍ في جميع أنحاء العالم ومن الناحية المثالية سيكون لدينا مركز توزيع في كل قارة. ومع ذلك ، فإن ذلك يعني شحن الأعمال الفنية مرتين. من المصنع إلى المستودع ، ومن المستودع إلى العميل ، مما يؤدي إلى ارتفاع انبعاثات ثاني أكسيد الكربون. بدلاً من ذلك ، نختار إنشاء أعمال فنية عند الطلب لتقليل النفايات ، والشحن للعملاء مباشرةً من مصنع Ecstase لتقليل بصمتنا الكربونية.', 'knitwork'),
    ('7', 'Forgotten', 'images/5f47a2aa77a6e.jpg', '60', '60', '20', '20', '100', '20', '20', '200', '20', '20', '300', 'Each artwork is made available in three sizes: 30x40cm (12x16\"), 50x66.5cm (20x26\") and 70x93.5cm (28x37\").', 'Print material: 200gsm canvas Print ink.', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Please allow 9-12 days for your order to arrive.  Why so long?', 'Marupa wood, neodynium magnets', 'Semi-gloss', '3', '2020-08-27 10:10:18', '2020-08-27 10:11:20', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'knitwork'),
    ('8', 'Finding Ways In Space', 'images/5f4a127c70c54.jpg', '20', '20', '5', '5', '40', '5', '5', '100', '10', '10', '30', 'Each artwork is made available in three sizes: 30x40cm (12x16"), 50x66.5cm (20x26") and 70x93.5cm (28x37"). To see how they look in real life click on the sizes and it will change in the room. This means that the limited edition is split up into three sizes, and the individual sizes are even more limited.', '200 gsm canvas Print ink.', '12-colour digital, archival ink', 'Matte', 'Marupa wood, neodynium magnets', 'Semi-gloss', '1', '2020-08-29 08:31:56', '2020-08-29 08:31:56', NULL, '0', 'كل عمل فني متوفر بثلاثة أحجام: 30 × 40 سم (12 × 16 بوصة) ، 50 × 66.5 سم (20 × 26 بوصة) و 70 × 93.5 سم (28 × 37 بوصة). لترى كيف تبدو في الواقع ، انقر على الأحجام وستتغير في الغرفة هذا يعني أن الإصدار المحدود مقسم إلى ثلاثة أحجام ، كما أن الأحجام الفردية محدودة بدرجة أكبر.', '٢٠٠ جرام', 'حبر أرشيفية رقمي 12 لونًا', 'مادة', 'خشب ماروبا ، مغناطيس نيودينيوم', 'شبه لامع', 'This limited edition release is printed in bright, vivid colors on a thick piece of woven canvas. Each print contains a serial number guaranteeing its originality. Part of the Ecstase Originals collection of a limited edition of 25. This artwork has been created in collaboration with Taudalpoi and is available only at Ecstase, making the 25 pieces the only ones in the world. Each piece in this special series is completed by our carefully crafted engraved frames, which showcase the name of the artist.

This complex and somewhat confronting piece is wonderfully earthy, considering its cosmic backdrop.', 'تمت طباعة هذا الإصدار المحدود بألوان زاهية وحيوية على قطعة سميكة من القماش المنسوج. تحتوي كل طبعة على رقم تسلسلي يضمن أصالتها. جزء من مجموعة Ecstase Originals من إصدار محدود من 25 نسخة. تم إنشاء هذا العمل الفني بالتعاون مع Taudalpoi وهو متاح فقط في Ecstase ، مما يجعل 25 قطعة هي الوحيدة في العالم. يتم استكمال كل قطعة في هذه السلسلة الخاصة بإطاراتنا المنقوشة المصنوعة بعناية والتي تعرض اسم الفنان.

هذه القطعة المعقدة والتي تواجه نوعًا ما هي قطعة ترابية رائعة ، بالنظر إلى خلفيتها الكونية.', 'Please allow 9-12 days for your order to arrive.

Why so long?

Because a limited edition artwork is worth waiting for? Yes. But also because the environmental impact of worldwide shipping is enormous. Our customers are pretty equally distributed worldwide and ideally we would have a distribution centre on each continent. However, that would mean shipping the artworks twice. From the factory to the warehouse, and from the warehouse to the customer, resulting in higher CO2 emissions. Instead, we choose on-demand creation of artworks to minimise waste, and shipping to customers directly from the Ecstase factory to minimise our carbon footprint.', 'يُرجى الانتظار 9-12 يومًا حتى يصل طلبك.

لماذا كل هذا الوقت؟

لأن عمل فني محدود الإصدار يستحق الانتظار؟ نعم. ولكن أيضًا لأن التأثير البيئي للشحن في جميع أنحاء العالم هائل. يتم توزيع عملائنا بشكل متساوٍ في جميع أنحاء العالم ومن الناحية المثالية سيكون لدينا مركز توزيع في كل قارة. ومع ذلك ، فإن ذلك يعني شحن الأعمال الفنية مرتين. من المصنع إلى المستودع ، ومن المستودع إلى العميل ، مما يؤدي إلى ارتفاع انبعاثات ثاني أكسيد الكربون. بدلاً من ذلك ، نختار إنشاء الأعمال الفنية عند الطلب لتقليل النفايات ، والشحن للعملاء مباشرةً من مصنع Ecstase لتقليل بصمتنا الكربونية.', 'ecstase originals'),
    ('9', 'Nameless 3920', 'images/5f4a29eb984c9.jpg', '100', '100', '0', '0', '0', '40', '40', '50', '60', '60', '200', 'Each artwork is made available in three sizes: 30x40cm (12x16"), 50x66.5cm (20x26") and 70x93.5cm (28x37"). To see how they look in real life click on the sizes and it will change in the room. This means that the limited edition is split up into three sizes, and the individual sizes are even more limited.', '200 gsm canvas Print ink.', '12-colour digital, archival ink', 'Matte', 'Marupa wood, neodynium magnets', 'Semi-gloss', '1', '2020-08-29 10:11:55', '2020-08-29 10:11:55', NULL, '0', 'كل عمل فني متوفر بثلاثة أحجام: 30 × 40 سم (12 × 16 بوصة) ، 50 × 66.5 سم (20 × 26 بوصة) و 70 × 93.5 سم (28 × 37 بوصة).', '٢٠٠ جرام', 'حبر أرشيفية رقمي 12 لونًا', 'مادة', 'خشب ماروبا ، مغناطيس نيودينيوم', 'شبه لامع', 'This is The Classic, a series that is designed as an elegant way to add a high-end touch to your space.

Each of the artworks has been printed and painted by hand on art-grade paper and is delivered professionally framed to ensure the longevity of the artwork.

The Classic is made up of a wooden frame, a passe-partout, and glass.

You can install it as soon as it is delivered as the artwork comes ready to be hung on your wall.

Part of the Ecstase Originals collection, a limited run of 25. This artwork has been created in collaboration with Norris Yim and is available only at Ecstase, making the 25 pieces the only ones in the world. Each artwork contains a signed certificate of authenticity that guarantees its originality.

"Using the Violence Painting style with Big Brush Stroke to create the Emotionally charged raw imagery with Heavy Color Experimentation texture to enhance the form of portrait." - Norris Yim', 'هذه هي السلسلة الكلاسيكية المصممة لتكون طريقة أنيقة لإضافة لمسة راقية إلى مساحتك.

تمت طباعة ورسم كل عمل فني يدويًا على ورق من الدرجة الفنية ويتم تسليمه في إطار احترافي لضمان استمرارية العمل الفني.

يتكون Classic من إطار خشبي وجزء ممر وزجاج.

يمكنك تثبيته بمجرد تسليمه حيث يصبح العمل الفني جاهزًا للتعليق على الحائط.

جزء من مجموعة Ecstase Originals ، عدد محدود من 25 قطعة. تم إنشاء هذا العمل الفني بالتعاون مع Norris Yim وهو متاح فقط في Ecstase ، مما يجعل 25 قطعة هي الوحيدة في العالم. يحتوي كل عمل فني على شهادة أصالة موقعة تضمن أصالته.

"استخدام نمط رسم العنف مع ضربة الفرشاة الكبيرة لإنشاء صور خام مشحونة عاطفياً مع نسيج تجريبي للألوان الثقيلة لتحسين شكل الصورة." - نوريس يم', 'Please allow 9-12 days for your order to arrive.

Why so long?

Because a limited edition artwork is worth waiting for? Yes. But also because the environmental impact of worldwide shipping is enormous. Our customers are pretty equally distributed worldwide and ideally we would have a distribution centre on each continent. However, that would mean shipping the artworks twice. From the factory to the warehouse, and from the warehouse to the customer, resulting in higher CO2 emissions. Instead, we choose on-demand creation of artworks to minimise waste, and shipping to customers directly from the Ecstase factory to minimise our carbon footprint.', 'يُرجى الانتظار 9-12 يومًا حتى يصل طلبك.

لماذا كل هذا الوقت؟

لأن عمل فني محدود الإصدار يستحق الانتظار؟ نعم. ولكن أيضًا لأن التأثير البيئي للشحن في جميع أنحاء العالم هائل. يتم توزيع عملائنا بشكل متساوٍ في جميع أنحاء العالم ومن الناحية المثالية سيكون لدينا مركز توزيع في كل قارة. ومع ذلك ، فإن ذلك يعني شحن الأعمال الفنية مرتين. من المصنع إلى المستودع ، ومن المستودع إلى العميل ، مما يؤدي إلى ارتفاع انبعاثات ثاني أكسيد الكربون. بدلاً من ذلك ، نختار إنشاء أعمال فنية عند الطلب لتقليل النفايات ، والشحن للعملاء مباشرةً من مصنع Ecstase لتقليل بصمتنا الكربونية.', 'ecstase originals');


INSERT INTO "users"
    ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "admin_role")
VALUES
    ('1', 'artwork', 'admin@gmail.com', NULL, '$2y$10$nrEjB5U4uaz5/MHA80SG8.GfL6O90F2vJ0Fcdxu19BLtUlZK9ozu.', NULL, NULL, NULL, '1'),
    ('2', 'admin', 'admin@admin.com', NULL, '$2y$10$0MfobkU0hOlEHnOL.5L7AezVnlyIqRwjDeuaM9H1D2tKihX.xpABG', NULL, '2020-08-30 15:08:10', '2020-08-30 15:08:10', '1');

