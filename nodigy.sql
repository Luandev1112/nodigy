-- Adminer 4.8.1 MySQL 5.5.5-10.5.19-MariaDB-0+deb11u2 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `admin_password_resets`;
CREATE TABLE `admin_password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `admin_password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `chains`;
CREATE TABLE `chains` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `chain_name` varchar(255) DEFAULT NULL,
  `chain_id` varchar(255) DEFAULT NULL,
  `chain_logo` longtext DEFAULT NULL,
  `chain_type` tinyint(4) NOT NULL DEFAULT 0,
  `chain_token` varchar(255) DEFAULT NULL,
  `network_id` int(11) DEFAULT NULL,
  `chain_hexa_id` varchar(255) DEFAULT NULL,
  `chain_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `block_chains_chain_name_index` (`chain_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `chains` (`id`, `chain_name`, `chain_id`, `chain_logo`, `chain_type`, `chain_token`, `network_id`, `chain_hexa_id`, `chain_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'BSC',	'10000001',	NULL,	0,	NULL,	1,	NULL,	1,	1,	1,	'2023-05-19 14:42:43',	'2023-06-01 09:58:11',	'2023-06-01 09:58:11'),
(2,	'CORE',	'10000002',	NULL,	0,	NULL,	1,	NULL,	1,	1,	1,	'2023-05-19 14:42:48',	'2023-06-01 09:58:13',	'2023-06-01 09:58:13'),
(3,	'Ethereum',	'1',	'chain_img_64786bc85c87f_1685613512.png',	0,	'ETH',	1,	NULL,	0,	1,	1,	'2023-05-19 14:42:54',	'2023-06-08 12:09:32',	NULL),
(4,	'Polygon',	'10000004',	'chain_img_64786bfcb26fa_1685613564.png',	0,	'MATIC',	1,	NULL,	1,	1,	1,	'2023-05-19 14:43:01',	'2023-06-01 09:59:24',	NULL),
(5,	'TRX',	'10000005',	NULL,	0,	NULL,	1,	NULL,	1,	1,	1,	'2023-05-19 14:43:07',	'2023-06-01 10:00:03',	'2023-06-01 10:00:03'),
(6,	'ALtLayer',	'10000006',	'chain_img_646dcc600bae0_1684917344.png',	1,	'ETH',	1,	NULL,	0,	1,	1,	'2023-05-24 08:35:44',	'2023-06-01 09:57:50',	NULL),
(7,	'SUI',	'10000007',	'chain_img_646dcd460e250_1684917574.png',	0,	'SUI',	2,	NULL,	0,	1,	1,	'2023-05-24 08:39:34',	'2023-06-08 12:09:12',	NULL),
(8,	'NYM',	'NYM',	'chain_img_64776312c7fb5_1685545746.jpg',	0,	'NYM',	3,	NULL,	1,	1,	1,	'2023-05-31 15:09:06',	'2023-06-01 09:22:26',	NULL),
(9,	'test chain',	'Test',	'chain_img_6478602412b90_1685610532.jpg',	0,	'sff5s6f5s6f5s6f5dsf',	1,	NULL,	1,	1,	1,	'2023-06-01 09:08:52',	'2023-06-01 09:59:32',	'2023-06-01 09:59:32'),
(10,	'Ethereum Goerli',	'5',	'chain_img_64786c99a0880_1685613721.png',	1,	'gETH',	1,	NULL,	1,	1,	1,	'2023-06-01 10:02:01',	'2023-06-01 10:02:01',	NULL),
(11,	'Arbitrum',	'42161',	'chain_img_64786ce67be0c_1685613798.png',	0,	'ARB',	1,	NULL,	0,	1,	1,	'2023-06-01 10:03:18',	'2023-06-08 12:09:24',	NULL),
(12,	'Taiko',	'167004',	'chain_img_64786d45e83b1_1685613893.png',	1,	'ETH',	1,	NULL,	1,	1,	1,	'2023-06-01 10:04:53',	'2023-06-01 10:04:53',	NULL),
(13,	'StarkNet',	'Stark',	'chain_img_64786d90ee140_1685613968.png',	0,	'ETH',	1,	NULL,	1,	1,	1,	'2023-06-01 10:06:08',	'2023-06-01 10:06:08',	NULL),
(14,	'Kyve',	'KYVE',	'chain_img_64786dcae2357_1685614026.png',	0,	'KYVE',	6,	NULL,	1,	1,	1,	'2023-06-01 10:07:06',	'2023-06-01 10:07:06',	NULL),
(15,	'Lamina1',	'7649',	'chain_img_64786e425de7b_1685614146.png',	1,	'L1',	1,	NULL,	1,	1,	1,	'2023-06-01 10:09:06',	'2023-06-01 10:09:06',	NULL),
(16,	'Shardeum',	'8081',	'chain_img_64786e677b40b_1685614183.png',	1,	'SHM',	1,	NULL,	1,	1,	1,	'2023-06-01 10:09:43',	'2023-06-01 10:09:43',	NULL),
(17,	'Algorand',	'ALGO',	'chain_img_647876f7bade9_1685616375.png',	1,	'ALGO',	9,	NULL,	1,	1,	1,	'2023-06-01 10:46:15',	'2023-06-01 10:46:15',	NULL),
(18,	'Scroll',	'534354',	'chain_img_647878db82905_1685616859.png',	1,	'TSETH',	1,	NULL,	0,	1,	1,	'2023-06-01 10:54:19',	'2023-06-08 12:09:49',	NULL),
(19,	'Base',	'84531',	'chain_img_647879bb70798_1685617083.png',	1,	'ETH',	1,	NULL,	1,	1,	1,	'2023-06-01 10:58:03',	'2023-06-01 10:58:03',	NULL),
(20,	'Tron',	'10000020',	'chain_img_64aea0894357d_1689165961.png',	0,	'TRX',	10,	'TRX',	1,	1,	1,	'2023-07-12 12:25:18',	'2023-07-12 12:46:01',	NULL);

DROP TABLE IF EXISTS `data_centers`;
CREATE TABLE `data_centers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `server_id` varchar(255) DEFAULT NULL,
  `server_name` varchar(255) DEFAULT NULL,
  `datacenter_id` varchar(255) DEFAULT NULL,
  `datacenter_name` varchar(255) DEFAULT NULL,
  `cpu` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `ssd` varchar(255) DEFAULT NULL,
  `os` varchar(255) DEFAULT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `price_hourly_net` varchar(255) DEFAULT NULL,
  `price_hourly_gross` varchar(255) DEFAULT NULL,
  `price_monthly_net` varchar(255) DEFAULT NULL,
  `price_monthly_gross` varchar(255) DEFAULT NULL,
  `api_log` longtext DEFAULT NULL,
  `sync_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `data_centers_server_id_sync_date_index` (`server_id`,`sync_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2023_02_23_091150_create_subscription_table',	2),
(5,	'2023_03_13_064917_add_subscribe_type_table',	3),
(6,	'2016_06_01_000001_create_oauth_auth_codes_table',	4),
(7,	'2016_06_01_000002_create_oauth_access_tokens_table',	4),
(8,	'2016_06_01_000003_create_oauth_refresh_tokens_table',	4),
(9,	'2016_06_01_000004_create_oauth_clients_table',	4),
(10,	'2016_06_01_000005_create_oauth_personal_access_clients_table',	4),
(11,	'2023_05_17_123416_create_project_table',	5),
(12,	'2023_05_19_131011_create_block_chains_table',	6),
(13,	'2023_05_19_131041_create_supported_wallets_table',	6),
(14,	'2023_05_22_063957_create_networks_table',	7),
(15,	'2023_05_22_115953_add_more_field_to_block_chains_table',	7),
(16,	'2023_05_23_060751_add_more_field_to_supported_wallets_table',	7),
(17,	'2023_05_23_091642_rename_block_chain_network_type_table',	7),
(18,	'2023_05_30_075836_change_type_network_id_supported_wallets_table',	8),
(19,	'2023_05_30_124536_rename_supported_wallets_table',	8),
(20,	'2023_05_31_060719_create_news_category_table',	9),
(21,	'2023_05_31_060738_create_news_table',	9),
(22,	'2023_06_01_054015_change_chain_sno_block_chains_table',	9),
(23,	'2023_06_12_050915_add_balance_to_users_table',	10),
(24,	'2023_06_12_052207_create_user_transactions_table',	10),
(25,	'2023_06_12_105414_create_user_wallet_table',	11),
(26,	'2023_06_12_105425_create_servers_table',	11),
(27,	'2023_06_12_105434_create_nodes_table',	11),
(28,	'2023_06_12_135028_rename_block_chain_id_table',	11),
(29,	'2023_06_12_135134_add_more_field_to_project_table',	11),
(30,	'2023_06_12_140000_add_wallet_type_table',	11),
(31,	'2023_06_12_140257_rename_chain_sno_table',	11),
(32,	'2023_06_12_140512_add_chain_hexa_id_table',	11),
(33,	'2023_06_12_140852_rename_block_chains_table_to_chains_table',	11),
(34,	'2023_06_12_142758_create_settings_table',	11),
(35,	'2023_06_21_090507_create_wizard_settings_table',	12),
(36,	'2023_06_22_061319_create_wizard_setting_steps_table',	12),
(37,	'2023_06_23_115142_add_project_token_to_project_table',	13),
(38,	'2023_06_23_122915_add_chain_id_to_wizard_settings_table',	13),
(39,	'2023_06_28_071730_create_data_centers_table',	13),
(40,	'2023_05_12_050222_remove_unique_constraint_from_email_column_in_users_table',	14),
(41,	'2023_05_12_065241_create_admin_password_resets_table',	14),
(42,	'2023_07_12_132459_add_node_status_and_node_type_to_nodes_table',	15);

DROP TABLE IF EXISTS `networks`;
CREATE TABLE `networks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `network_name` varchar(255) DEFAULT NULL,
  `network_sno` int(11) DEFAULT NULL,
  `network_logo` varchar(255) DEFAULT NULL,
  `network_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `networks_network_name_index` (`network_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `networks` (`id`, `network_name`, `network_sno`, `network_logo`, `network_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'EVM',	10000001,	'network_img_647869418328d_1685612865.png',	1,	1,	1,	'2023-05-24 08:34:43',	'2023-06-01 09:47:45',	NULL),
(2,	'SUI',	10000002,	'network_img_646dcd2bb9fb7_1684917547.png',	1,	1,	1,	'2023-05-24 08:39:07',	'2023-06-01 09:06:30',	NULL),
(3,	'NYX',	10000003,	'network_img_6478687ced509_1685612668.png',	1,	1,	1,	'2023-05-31 15:07:58',	'2023-06-01 09:44:28',	NULL),
(4,	'Solana',	10000004,	'network_img_6478697bd4976_1685612923.svg',	1,	1,	1,	'2023-06-01 09:48:43',	'2023-06-01 09:48:43',	NULL),
(5,	'Cardano',	10000005,	'network_img_647869aa1cf3e_1685612970.svg',	1,	1,	1,	'2023-06-01 09:49:30',	'2023-06-01 09:49:30',	NULL),
(6,	'Cosmos',	10000006,	'network_img_64786a96b5072_1685613206.png',	1,	1,	1,	'2023-06-01 09:53:26',	'2023-06-01 09:53:26',	NULL),
(7,	'Shardeum',	10000007,	'network_img_64786b044747a_1685613316.png',	1,	1,	1,	'2023-06-01 09:55:16',	'2023-06-01 09:55:16',	NULL),
(8,	'Lamina1',	10000008,	'network_img_64786b4a228a1_1685613386.png',	1,	1,	1,	'2023-06-01 09:56:26',	'2023-06-01 09:56:26',	NULL),
(9,	'Algorand',	10000009,	'network_img_647876d875605_1685616344.png',	1,	1,	1,	'2023-06-01 10:45:44',	'2023-06-01 10:45:44',	NULL),
(10,	'Tron',	10000010,	'network_img_64aea0962a553_1689165974.png',	1,	1,	1,	'2023-07-12 12:24:41',	'2023-07-12 12:46:14',	NULL);

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `news_category_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tags` longtext DEFAULT NULL,
  `publish_at` date DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `share_twitter` tinyint(4) NOT NULL DEFAULT 0,
  `share_telegram` tinyint(4) NOT NULL DEFAULT 0,
  `share_facebook` tinyint(4) NOT NULL DEFAULT 0,
  `news_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_news_category_id_title_index` (`news_category_id`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `news` (`id`, `news_category_id`, `title`, `tags`, `publish_at`, `description`, `image`, `share_twitter`, `share_telegram`, `share_facebook`, `news_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	'The standard Lorem Ipsum passage, used since the 1500s',	'Top,Test,Demo',	'2023-06-01',	'<h1 class=\"ql-align-center\">Lorem Ipsum</h1><p class=\"ql-align-center\"><br></p><p><strong style=\"color: rgb(0, 0, 0);\">Lorem Ipsum</strong><span style=\"color: rgb(0, 0, 0);\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><br></p><p><img src=\"data:image/jpeg;base64,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\" style=\"display: block; margin: auto;\" align=\"center\"></p><p><br></p><p class=\"ql-align-justify\">\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\"</p><h3>Section 1.10.32 of \"de Finibus Bonorum et Malorum\", written by Cicero in 45 BC</h3><p class=\"ql-align-justify\">\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"</p><h3>1914 translation by H. Rackham</h3><p class=\"ql-align-justify\">\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p><p><br></p><p><br></p>',	'news_img_64786579ac4b0_1685611897.jpg',	1,	0,	1,	1,	1,	1,	'2023-06-01 09:31:37',	'2023-06-01 09:31:37',	NULL);

DROP TABLE IF EXISTS `news_category`;
CREATE TABLE `news_category` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `news_category_category_name_index` (`category_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `news_category` (`id`, `category_name`, `image`, `category_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Top News',	'news_cat_img_647864db29716_1685611739.jpg',	1,	1,	1,	'2023-06-01 09:28:59',	'2023-06-01 09:28:59',	NULL);

DROP TABLE IF EXISTS `nodes`;
CREATE TABLE `nodes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `server_id` bigint(20) unsigned DEFAULT NULL,
  `user_wallet_id` bigint(20) unsigned DEFAULT NULL,
  `node_name` varchar(255) DEFAULT NULL,
  `node_status` tinyint(4) NOT NULL DEFAULT 0,
  `node_type` enum('test','main') DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nodes_user_id_project_id_server_id_user_wallet_id_index` (`user_id`,`project_id`,`server_id`,`user_wallet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('85028ec3aeab1779814522a7632d543b3cab6b264156d672a7f22a64b3f2c91aab2eec1ae7577a8c',	10,	1,	'MyApp',	'[]',	0,	'2023-04-03 09:42:24',	'2023-04-03 09:42:24',	'2024-04-03 09:42:24');

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1,	NULL,	'Nodigy Personal Access Client',	'LIiHzNOFrlcPbyRxAS6kcxvVR98tINjH70K7HgVY',	NULL,	'http://localhost',	1,	0,	0,	'2023-04-03 09:00:06',	'2023-04-03 09:00:06'),
(2,	NULL,	'Nodigy Password Grant Client',	'XCxokGoMsNUtGyBJlmPFdY2uRjF4llxK2ra68JDJ',	'users',	'http://localhost',	0,	1,	0,	'2023-04-03 09:00:06',	'2023-04-03 09:00:06');

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1,	1,	'2023-04-03 09:00:06',	'2023-04-03 09:00:06');

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('bhalodiyaravi@gmail.com',	'$2y$10$AnJnAltlKM2xF.BEZRhwbuq9SCyDjoIram3u.ZcDPOS8Cw44Wz.Y6',	'2023-02-28 13:35:29'),
('yiicakephp@gmail.com',	'$2y$10$6Ub7pmV3qJ6J85KffbVgxu/dkaZU.ejtvS0Vy7cWRxa1gYNeHawJe',	'2023-05-02 06:06:56'),
('hardik.amcodr@gmail.com',	'$2y$10$dcBNjQ78bO9.QKGa6.olVepPRHvS1ydlfj/JP3vKwG53bysuOwGRO',	'2023-05-03 11:09:38');

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `project_token` varchar(255) DEFAULT NULL,
  `project_sno` varchar(255) DEFAULT NULL,
  `chain_id` int(11) DEFAULT NULL,
  `network_id` int(11) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `supp_wallet_id` varchar(255) DEFAULT NULL,
  `project_website` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `tags` longtext DEFAULT NULL,
  `explorer` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `network_type` tinyint(4) NOT NULL DEFAULT 1,
  `min_stake` varchar(255) DEFAULT NULL,
  `min_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `stake_unit` varchar(255) DEFAULT NULL,
  `onbording_fee` decimal(15,2) NOT NULL DEFAULT 0.00,
  `project_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `project_project_name_project_id_index` (`project_name`,`project_sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `project` (`id`, `project_name`, `project_token`, `project_sno`, `chain_id`, `network_id`, `description`, `supp_wallet_id`, `project_website`, `twitter_url`, `tags`, `explorer`, `image`, `network_type`, `min_stake`, `min_price`, `stake_unit`, `onbording_fee`, `project_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Dev test',	NULL,	'10000001',	6,	1,	'test',	'1,2',	'https://Project.com',	'https://Twitter.com',	'aaaa,bbbb,cccc',	'https://demo.com/111,https://demo.com/222',	'project_img_64678b79b3465_1684507513.jpg',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-05-19 14:45:13',	'2023-06-01 09:28:37',	'2023-06-01 09:28:37'),
(2,	'NYM',	NULL,	'10000002',	8,	3,	'Nym is a protocol aiming to provide privacy for internet traffic. The decentralized NYM mix-net uses blockchain technology and economic incentives to provide powerful network-level privacy. The work of mixing your traffic is done by nodes, which are run by node runners incentivized via NYM tokens.',	'2',	'https://t.co/7nNa82ZPAq',	'https://twitter.com/nymproject',	'NYM, NYX, Privacy',	'https://explorer.nymtech.net/',	'project_img_647865f2be16b_1685612018.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-05-31 15:11:17',	'2023-06-01 09:33:38',	NULL),
(3,	'Forta',	NULL,	'10000003',	4,	1,	'Forta is a decentralized monitoring network dedicated to detecting threats and anomalies on Web 3.0 systems like DeFi. The network detects abnormalities in real-time with the help of independent node operators that scan all transactions and block-by-block state changes for outliers and threats.',	'1,3',	'https://t.co/v9dGpSibZB',	'https://twitter.com/FortaNetwork',	'Forta,Security,Fraud detection',	'https://explorer.forta.network/scan-node/',	'project_img_647872dcb55d9_1685615324.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:28:44',	'2023-06-01 10:28:44',	NULL),
(4,	'Starknet',	NULL,	'10000004',	13,	1,	'StarkNet is a permissionless decentralized Validity-Rollup (also known as a “ZK-Rollup”). It operates as an L2 network over Ethereum, enabling any dApp to achieve unlimited scale for its computation – without compromising Ethereum’s composability and security.\r\nStarkNet Sequencer Node is the main node of the StarkNet network. It implements the core functionality of sequencing transactions submitted to it, executes the StarkNet OS Cairo program, proves the result and updates the network state on the StarkNet Core Contract.',	'5,8',	'https://www.starknet.io/en',	'https://twitter.com/Starknet',	'Starknet,Layer 2,Scalability',	'https://starkscan.co/,https://voyager.online/',	'project_img_647873b51a21f_1685615541.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:32:21',	'2023-06-01 10:32:21',	NULL),
(5,	'Shardeum',	NULL,	'10000005',	16,	1,	'Shardeum is a linearly scalable EVM-based smart contract platform that always provides low gas cost while maintaining decentralization and strong security through dynamic state sharding like Near, Elrond and Harmony. This is a layer-1 blockchain that increases the number of transactions per second by increasing the number of nodes',	'1',	'https://t.co/B4ZuSRGqmF',	'https://twitter.com/shardeum',	'Shardeum,Shards,Scalability',	'https://explorer-liberty20.shardeum.org/?_ga=2.45607521.436015867.1685615661-1470911513.1674759151&_gl=1*n4fk4u*_ga*MTQ3MDkxMTUxMy4xNjc0NzU5MTUx*_ga_2VJLR99VYW*MTY4NTYxNTY2MS4yMS4xLjE2ODU2MTU2NjcuMC4wLjA.',	'project_img_64787455d4bc6_1685615701.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:35:01',	'2023-06-01 10:35:01',	NULL),
(6,	'Lamina1',	NULL,	'10000006',	15,	1,	'Lamina1 is a layer one blockchain ecosystem that’s set on providing the infrastructure for Web3 developers to build the “Open Metaverse.” With its user-friendly tooling, onboarding strategies and environmentally friendly approach, Lamina1 aims to help the metaverse hold true to a Web3 ethos.',	'1',	'https://www.lamina1.com/',	'https://twitter.com/Lamina1official',	'Lamina1, Metaverse',	'https://testnet-explorer.lamina1.global/',	'project_img_647875afddc03_1685616047.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:40:47',	'2023-06-01 10:40:47',	NULL),
(7,	'Ethereum Goerli',	NULL,	'10000007',	10,	1,	'Ethereum is the community-run technology powering the cryptocurrency ether (ETH) and thousands of decentralized applications.',	'1,3',	'https://ethereum.org/en/',	'https://twitter.com/ethereum',	'Ethereum,testnet',	'https://etherscan.io',	'project_img_64787686cd09e_1685616262.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:44:22',	'2023-06-01 10:44:22',	NULL),
(8,	'Goracle',	NULL,	'10000008',	17,	9,	'Goracle is a decentralized oracle network on the Algorand blockchain',	'9',	'https://t.co/oIzdRwGC8S',	'https://twitter.com/GoracleNetwork',	'Oracle, Algorand,Goracle',	'https://testnet-app.goracle.io/validators',	'project_img_6478780c9f9c6_1685616652.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:50:52',	'2023-06-01 10:50:52',	NULL),
(9,	'Taiko',	NULL,	'10000009',	12,	1,	'Taiko is a decentralized layer-1 blockchain, equivalent of Ethereum (ZK-EVM) built on ZK Rollup. It will have layer 1 and layer 2, and will allow applications, that are written for the Ethereum network, migrate to Taiko without any changes.',	'1',	'https://t.co/3YC1tr83Oi',	'https://twitter.com/taikoxyz',	'Taiko, Layer 2',	'https://explorer.a2.taiko.xyz',	'project_img_647878913bc92_1685616785.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:53:05',	'2023-06-01 10:53:05',	NULL),
(10,	'Scroll',	NULL,	'10000010',	18,	1,	'Scroll is a Layer-2 blockchain, zkEVM-based zkRollup on Ethereum that enables native compatibility for existing Ethereum applications and tools.',	'1',	'https://t.co/Pwca4Btay1',	'https://twitter.com/Scroll_ZKP',	'Scroll, Layer 2',	'https://l2scan.scroll.io',	'project_img_647879301c502_1685616944.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 10:55:44',	'2023-06-01 10:55:44',	NULL),
(11,	'Base',	NULL,	'10000011',	19,	1,	'Base is a secure, low-cost, developer-friendly Ethereum L2 built to bring the next billion users to web3. Base is the easiest way for decentralized apps to leverage Coinbase’s products and distribution. Base is powered by Optimism\'s OP Stack, making it one of the most secure, scalable EVM L2s out there. The OP Stack is an open-source public good that will serve as the foundation for a “superchain” of L2s that share interoperability, sequencing, and governance.',	'1',	'https://t.co/6pgVoBT5fJ',	'https://twitter.com/BuildOnBase',	'Base, Layer 2,Coinbase',	'https://goerli.basescan.org',	'project_img_64787a635af9b_1685617251.png',	1,	NULL,	0.00,	NULL,	0.00,	1,	1,	1,	'2023-06-01 11:00:51',	'2023-06-01 11:00:51',	NULL);

DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `server_name` varchar(255) DEFAULT NULL,
  `vcpus` varchar(255) DEFAULT NULL,
  `ram` varchar(255) DEFAULT NULL,
  `ssd` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `monthly_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servers_server_name_index` (`server_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `servers` (`id`, `server_name`, `vcpus`, `ram`, `ssd`, `country`, `monthly_price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Minimum required',	'1 Intel',	'2 GB',	'16 GB',	'fr',	20.00,	'2023-07-12 14:06:11',	'2023-07-12 14:06:11',	NULL);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `slug`, `label`, `content`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'app-name',	'App Name',	'Nodigy',	'2023-06-21 10:58:59',	'2023-06-21 10:58:59',	NULL),
(2,	'app-url',	'App Url',	'https://nodigy.com',	'2023-06-21 10:59:29',	'2023-06-21 10:59:29',	NULL);

DROP TABLE IF EXISTS `subscription`;
CREATE TABLE `subscription` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `subscription_status` tinyint(4) NOT NULL DEFAULT 0,
  `subscribe_type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `subscription` (`id`, `email`, `token`, `email_verified_at`, `subscription_status`, `subscribe_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'yiicakephp@gmail.com',	'WVIpkHftfjVfxCmHMLocHJ93FWVaUkQqNvqWOfExO2ukJy1dIItV4LeSpEY79C9R',	NULL,	0,	0,	'2023-02-24 10:01:02',	'2023-05-03 11:01:59',	NULL),
(2,	'chirag.amcodr@gmail.com',	'mAvuRwcsbr70bspxqCK0uTGFZiWGSJIVBKi1kOAV3u51J1LzqHvf2ArktaBxdmzL',	NULL,	0,	0,	'2023-02-24 10:01:58',	'2023-02-24 10:02:57',	NULL),
(3,	'bhalodiyaravi@gmail.com',	'rSOCYiDaXcxPP1cdZssWAbmNshGPyIohsADuEhQtS9jDRzr2PoWJM1eO5kUl8qia',	NULL,	0,	0,	'2023-02-24 10:07:25',	'2023-02-24 10:07:25',	NULL),
(4,	'yiicakephp@gmail.com',	'QJlgopvZjfEKzvRAMNaFnbYyz2FowvbpXYfwnGlpeZKKLHt2diVdDEcfPczEZRJD',	NULL,	0,	1,	'2023-03-13 13:40:42',	'2023-03-13 13:40:42',	NULL),
(5,	'lv.laier@gmail.com',	'm4yCA7mLwXm6TC3IfP6XC4cfiOdjIYIznHYSsO4Ei0piUSSqmSBMXddY8uSMueqa',	'2023-03-14 12:50:51',	1,	0,	'2023-03-14 10:54:10',	'2023-03-14 12:50:51',	NULL),
(6,	'bitcoin22@outlook.it',	'aVZ7nhsHjRhpCNcL81unPCkXhlNdwoLVAg05l4f3JNNvnHkMOV3gUA3Qznrgax6Y',	'2023-03-26 16:50:09',	1,	0,	'2023-03-25 21:29:55',	'2023-03-26 16:50:09',	NULL),
(7,	'cryptdon@protonmail.com',	'f6zs1Y4J93lh5Ex6wGPzh1PNf0TueyuemVvEPOOaEClCiyJAt5LDxrmV4DLUaJzS',	'2023-03-26 21:51:44',	1,	0,	'2023-03-26 21:27:42',	'2023-03-26 21:51:44',	NULL),
(8,	'anurg@yahoo.com',	'xek0L6CFfr7p6OLq39LcXnMs4FnF7isffRQDTHxo7xGvrcqShKywwTTvKYq8sIrn',	NULL,	0,	0,	'2023-03-27 03:54:03',	'2023-03-27 03:54:03',	NULL),
(9,	'nwtraon@gmail.com',	'6spb6PZ4MkWZK6jmSXtyTD11lOutrDV08ixvAyb16NK38GUGtW1t2MoIOzSEh2tF',	NULL,	0,	0,	'2023-04-17 10:16:47',	'2023-04-17 10:16:47',	NULL),
(10,	'demo@gmail.com',	'9MXEsd63jm3LR320PWEEeIAFrTwJEyQtJeAnEenzkdBq5JqVAMQ2PeWykyuY7sxD',	NULL,	0,	0,	'2023-05-03 11:26:08',	'2023-05-03 11:26:08',	NULL),
(11,	'brandonfarmer75@outlook.com',	'mEraP5WcVwCNPwDrTgVlDc0KQoz5RTYoQa1uL8hL1Ea1No0XWcgjsdawyjJy03KV',	NULL,	0,	0,	'2023-05-15 19:36:25',	'2023-05-15 19:51:20',	NULL),
(12,	'predovicalexandria138@gmail.com',	'uyiViB7GTDVuad7ppKSAkNHPmTH5HgUNCPl2sr9fyJ4AztZ8TaDrYSXI2ybiezQa',	NULL,	0,	0,	'2023-05-15 19:37:48',	'2023-05-15 19:49:56',	NULL),
(13,	'julie_lambert@ourtimesupport.com',	'J7ui87Mfm1Dne0CRHPrlVZu4W1kqi9F6MNz5aHzj7vimcmUJhnxlJzQ2V4HFv2zg',	NULL,	0,	0,	'2023-05-15 19:43:26',	'2023-05-15 19:43:26',	NULL),
(14,	'cristina39@ourtimesupport.com',	'nZmrLb0Kv4dYyHLxA2wcBEbutEnIW4XX1hoiurvoxrjnf9D8LL86ICb6cHYUYeCE',	NULL,	0,	0,	'2023-05-15 19:48:32',	'2023-05-15 19:48:32',	NULL);

DROP TABLE IF EXISTS `supported_wallets`;
CREATE TABLE `supported_wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supp_wallet_name` varchar(255) DEFAULT NULL,
  `wallet_sno` int(11) DEFAULT NULL,
  `wallet_logo` longtext DEFAULT NULL,
  `network_id` varchar(255) DEFAULT NULL,
  `wallet_type` varchar(255) DEFAULT NULL,
  `supp_wallet_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supported_wallets_supp_wallet_name_index` (`supp_wallet_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `supported_wallets` (`id`, `supp_wallet_name`, `wallet_sno`, `wallet_logo`, `network_id`, `wallet_type`, `supp_wallet_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'METAMASK',	10000001,	'wallet_img_64786ecbd2c8a_1685614283.png',	'1',	NULL,	1,	1,	1,	'2023-05-19 14:43:18',	'2023-06-01 10:11:23',	NULL),
(2,	'NYM WALLET',	10000002,	'wallet_img_64786e7d85780_1685614205.png',	'3',	NULL,	1,	1,	1,	'2023-05-19 14:43:25',	'2023-06-01 10:10:05',	NULL),
(3,	'TrustWallet',	10000003,	'wallet_img_646dccb7508b6_1684917431.png',	'1',	NULL,	1,	1,	1,	'2023-05-24 08:37:11',	'2023-05-24 08:37:51',	NULL),
(4,	'SUI Wallet',	10000004,	'wallet_img_64786eb397b04_1685614259.png',	'2',	NULL,	1,	1,	1,	'2023-05-24 08:40:04',	'2023-06-01 10:10:59',	NULL),
(5,	'Braavos',	34534,	'wallet_img_64776017b146e_1685544983.jpg',	'1',	NULL,	1,	1,	1,	'2023-05-31 14:56:23',	'2023-05-31 14:56:23',	NULL),
(6,	'Keplr',	10000006,	'wallet_img_64786edfd6d02_1685614303.png',	'6',	NULL,	1,	1,	1,	'2023-06-01 10:11:43',	'2023-06-01 10:11:43',	NULL),
(7,	'Phantom',	10000007,	'wallet_img_64786f7e1d737_1685614462.png',	'4',	NULL,	1,	1,	1,	'2023-06-01 10:14:22',	'2023-06-01 10:14:22',	NULL),
(8,	'ArgentX',	10000008,	'wallet_img_647870077e846_1685614599.png',	'1',	NULL,	1,	1,	1,	'2023-06-01 10:16:39',	'2023-06-01 10:16:39',	NULL),
(9,	'Pera',	10000009,	'wallet_img_64787759e29ae_1685616473.png',	'9',	NULL,	1,	1,	1,	'2023-06-01 10:47:53',	'2023-06-01 10:47:53',	NULL),
(10,	'TronLink',	10000010,	'wallet_img_64aea07746f67_1689165943.png',	'10',	NULL,	1,	1,	1,	'2023-07-12 12:27:37',	'2023-07-12 12:45:43',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `balance` decimal(20,2) NOT NULL DEFAULT 0.00,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `otp_code` varchar(255) DEFAULT NULL,
  `otp_valid_time` varchar(255) DEFAULT NULL,
  `is_verify` tinyint(4) NOT NULL DEFAULT 0,
  `role_type` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `balance`, `name`, `email`, `email_verified_at`, `password`, `otp_code`, `otp_valid_time`, `is_verify`, `role_type`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	0.00,	'Nodigy Admin',	'admin@gmail.com',	'2023-05-10 07:57:22',	'$2y$10$MQsxFvyEPFuYStO2GoSPq.J6kGYGUADx9dLl3ntVzOlai4D5VzW2y',	'88446',	'1675429239',	0,	1,	1,	'wFHLuzXUBClvRdGDUbYcdEjBXUei8gFQchRE70pUHIc3ySZGrAfUXnjpkETi',	'2023-01-25 16:28:02',	'2023-05-10 07:58:06',	NULL),
(2,	0.00,	'',	'monichawellagady@gmail.com',	NULL,	'$2y$10$bp6ZRXSryL0CC/WgRz58iODJotQ.SMZIioyAkyS.0L85zO8qY.nim',	'34896',	'1675094862',	0,	2,	0,	NULL,	'2023-01-30 15:52:40',	'2023-01-30 16:05:42',	NULL),
(3,	0.00,	'',	'feriyantores@gmail.com',	NULL,	'$2y$10$TykfGP9rruZ.DAVSTAbjg.X3Uys7BgWGwDhNq50VC293hC4tU/2ly',	'55398',	'1675094663',	0,	2,	0,	NULL,	'2023-01-30 15:57:22',	'2023-01-30 16:02:23',	NULL),
(4,	0.00,	'',	'cavalon26@gmail.com',	NULL,	'$2y$10$qVXYb5Ghx3yaZw2IXe6hq.f5mXce4WdAxRKEPIKqrxaGX9a5RMtt2',	'91887',	'1675149282',	0,	2,	0,	NULL,	'2023-01-31 04:21:04',	'2023-01-31 07:12:42',	NULL),
(5,	0.00,	'',	'bhalodiyaravi@gmail.com',	'2023-02-03 13:05:39',	'$2y$10$xk8VJv35x3tygswFwjHYZuGzznfzZ3B1i0P9RnF.Y7ypigi3RZVwa',	NULL,	NULL,	1,	2,	1,	NULL,	'2023-02-03 13:00:04',	'2023-02-03 13:05:39',	NULL),
(6,	0.00,	'',	'baris32@gmail.com',	'2023-02-03 22:04:05',	'$2y$10$uhjNJsyuAZpLs.gkEeOY3.srT3OjZS2ayF7WGopxkvmWFhYzP5AJy',	NULL,	NULL,	1,	2,	1,	NULL,	'2023-02-03 22:01:21',	'2023-02-03 22:04:05',	NULL),
(7,	0.00,	'',	'dikanirmala7@gmail.com',	'2023-02-06 05:58:25',	'$2y$10$GUeZk1iD08aC1CPQJwwoN.zoNQAkQLP0WCRQjcyeif80AynzOvpOq',	NULL,	NULL,	1,	2,	1,	NULL,	'2023-02-06 05:57:51',	'2023-02-06 05:58:25',	NULL),
(8,	0.00,	'',	'chien.truong75@gmail.com',	NULL,	'$2y$10$YUtEvPsLMmLR35nk0bv2NetJbDg966w/dB4Gm2jgBOw.ibJ.dMb3u',	'23907',	'1675783631',	0,	2,	0,	NULL,	'2023-02-07 15:15:58',	'2023-02-07 15:25:11',	NULL),
(9,	0.00,	'',	'marcel.nagy@gmail.com',	'2023-02-18 14:23:25',	'$2y$10$F.QT62n9hNU3QQ/UTL4sxuY3Y..Ys8Szhqyu5DanBPaJ7Ezdx5KBO',	NULL,	NULL,	1,	2,	1,	NULL,	'2023-02-18 14:22:58',	'2023-02-18 14:23:25',	NULL),
(10,	500.00,	'',	'lv.laier@gmail.com',	'2023-03-23 09:01:30',	'$2y$10$H/QVHQgsnfKSQokE65cWp.RDPUATLMBl1ng7z8mPhmXfmhsn3onP2',	NULL,	NULL,	1,	2,	1,	'pmVsCd65QMpBp0VR6lq0TlmLaw7aWwbfp2V9AS5rILRgmqCE1AHhvHxgm1mD',	'2023-02-22 10:56:38',	'2023-07-12 14:07:13',	NULL),
(11,	0.00,	'',	'didiasc@gmail.com',	'2023-03-22 15:53:23',	'$2y$10$Vh9WCgPszS0c/WSjOHzKrOLkpTpJvpi4HUjUgMxuBl34yQ8gsW08i',	NULL,	NULL,	1,	2,	1,	'eWNxyIkn0WcfG9WtvMVgM6j8dEgqfUEADhRdQ4vhuOWV1aLwC6yh7DV3xEeo',	'2023-03-02 15:05:17',	'2023-03-22 15:53:23',	NULL),
(12,	0.00,	'',	'al.b.ertha.n.s.h.in.4.9@gmail.com',	NULL,	'$2y$10$UZcnN4qq8GBXqCLXRhGWcu8J7f5s4BKgUl3vA1DUYH5D14Z.1ecO6',	'53518',	'1677868467',	0,	2,	0,	NULL,	'2023-03-03 18:32:27',	'2023-03-03 18:32:27',	NULL),
(13,	0.00,	'',	'triasx6@gmail.com',	'2023-03-25 13:56:18',	'$2y$10$o5WuK3i76C3Vd9LpAjmSeOTyBtLfR7/S8wwLnRQOf7t0hP1rvDgN.',	NULL,	NULL,	1,	2,	1,	NULL,	'2023-03-25 13:43:13',	'2023-03-25 13:56:18',	NULL),
(14,	0.00,	'',	'a.lbe.r.t.h.a.nsh.i.n.49@gmail.com',	NULL,	'$2y$10$N1sTjlXtBOIWs.557sNjteBZ/x5rtzEMT72ZJDb5GyXOGEa7s8nQW',	'63440',	'1680957517',	0,	2,	0,	NULL,	'2023-04-08 12:36:37',	'2023-04-08 12:36:37',	NULL),
(15,	0.00,	'',	'girtalos@yandex.com',	NULL,	'$2y$10$qaoUtvGAskCz.RKymfDzHOIK4IPCqz.wcTU1trDH2vzuD5OZtwzem',	'99911',	'1682814583',	0,	2,	0,	NULL,	'2023-04-30 00:27:43',	'2023-04-30 00:27:43',	NULL),
(112,	0.00,	'Dev Admin',	'amcodr.admin@gmail.com',	'2023-01-23 12:44:35',	'$2y$10$8kUk/kj07S10nHCg3AiEUO3cQKgTs2MeL7C4pAd0jys4gaHCfPjeO',	NULL,	NULL,	0,	1,	1,	'POkkb9cNYA1hg3zUSNJlPMnQNSzxmIp1OP96GDc5Q4WuOtN5rRw2JwhzJh4s',	'2023-01-23 12:44:35',	'2023-06-28 14:29:02',	NULL),
(113,	50000.75,	'',	'chirag.amcodr@gmail.com',	'2023-05-11 06:25:48',	'$2y$10$rMbMou62E.i1fuO1stRDwOT/RvjsEgkMB0BWoyDkFqHiS9dvBqW6q',	NULL,	NULL,	1,	2,	1,	NULL,	'2023-05-11 06:25:27',	'2023-05-11 06:25:48',	NULL),
(114,	0.00,	'NewMod',	'info@nodigy.com',	'2023-05-11 10:08:09',	'$2y$10$ynpqGxXaKL6uulpjc3JED.1kQIllECdVOi09MrXlFu14fTbkgFeIG',	NULL,	NULL,	0,	1,	1,	NULL,	'2023-05-11 10:08:09',	'2023-05-12 09:34:27',	NULL),
(117,	0.00,	'Test Moderator',	'chirag.amcodr@gmail.com',	'2023-06-29 09:04:10',	'$2y$10$r4CDkwE4pNR0M3V0O/re/eBowR1JJiOQ6jNbjir3mtBpB65X7o6nW',	NULL,	NULL,	0,	1,	1,	NULL,	'2023-06-29 09:04:10',	'2023-06-29 09:04:10',	NULL);

DROP TABLE IF EXISTS `user_transactions`;
CREATE TABLE `user_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `amount` decimal(20,2) NOT NULL DEFAULT 0.00,
  `txn_id` varchar(255) DEFAULT NULL,
  `purpose` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_transactions_project_id_user_id_index` (`project_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `user_wallet`;
CREATE TABLE `user_wallet` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wallet_id` bigint(20) unsigned DEFAULT NULL,
  `network_id` bigint(20) unsigned DEFAULT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `wallet_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_wallet_wallet_id_network_id_user_id_index` (`wallet_id`,`network_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `user_wallet` (`id`, `wallet_id`, `network_id`, `user_id`, `wallet_name`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	7,	4,	10,	'Solana',	'BhSr7Mi4WYryrKAfGHKazEcwCwoSpHmRgBEVsHZPQTRi',	'2023-07-12 08:20:03',	'2023-07-12 08:38:05',	NULL),
(2,	6,	6,	10,	'Keplr123',	'cosmos1xvy6adtftrd4qpeg8gsw703g26w8altqepc6v7',	'2023-07-12 11:58:01',	'2023-07-12 11:58:01',	NULL),
(3,	5,	1,	10,	'Braavos',	'0x59a4bac33ac3f83d3a0c1b3f41d82bc3df73e412ba80fd837f550cda2638762',	'2023-07-12 12:19:11',	'2023-07-12 12:33:15',	NULL);

DROP TABLE IF EXISTS `wizard_settings`;
CREATE TABLE `wizard_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `difficulty` tinyint(4) NOT NULL DEFAULT 0,
  `min_stake` decimal(15,2) DEFAULT 0.00,
  `token` varchar(255) DEFAULT NULL,
  `gas_fee_token` varchar(255) DEFAULT NULL,
  `chain_id` varchar(255) DEFAULT NULL,
  `setup_fee` decimal(15,2) DEFAULT 0.00,
  `staking_amount` decimal(15,2) DEFAULT 0.00,
  `where_to_buy` longtext DEFAULT NULL,
  `is_video_guide_link` tinyint(4) NOT NULL DEFAULT 0,
  `video_guide_link` varchar(255) DEFAULT NULL,
  `is_text_guide_link` tinyint(4) NOT NULL DEFAULT 0,
  `text_guide_link` varchar(255) DEFAULT NULL,
  `min_req_vcpus` varchar(255) DEFAULT NULL,
  `min_req_vcpus_type` varchar(255) DEFAULT NULL,
  `min_req_ram` varchar(255) DEFAULT NULL,
  `min_req_ssd` varchar(255) DEFAULT NULL,
  `min_req_price` decimal(15,2) DEFAULT 0.00,
  `recom_vcpus` varchar(255) DEFAULT NULL,
  `recom_vcpus_type` varchar(255) DEFAULT NULL,
  `recom_ram` varchar(255) DEFAULT NULL,
  `recom_ssd` varchar(255) DEFAULT NULL,
  `recom_price` decimal(15,2) DEFAULT 0.00,
  `max_perf_vcpus` varchar(255) DEFAULT NULL,
  `max_perf_vcpus_type` varchar(255) DEFAULT NULL,
  `max_perf_ram` varchar(255) DEFAULT NULL,
  `max_perf_ssd` varchar(255) DEFAULT NULL,
  `max_perf_price` decimal(15,2) DEFAULT 0.00,
  `step_2_name` varchar(255) DEFAULT NULL,
  `step_2_description` longtext DEFAULT NULL,
  `step_2_video_link` varchar(255) DEFAULT NULL,
  `step_3_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wizard_settings_project_id_index` (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `wizard_settings` (`id`, `project_id`, `difficulty`, `min_stake`, `token`, `gas_fee_token`, `chain_id`, `setup_fee`, `staking_amount`, `where_to_buy`, `is_video_guide_link`, `video_guide_link`, `is_text_guide_link`, `text_guide_link`, `min_req_vcpus`, `min_req_vcpus_type`, `min_req_ram`, `min_req_ssd`, `min_req_price`, `recom_vcpus`, `recom_vcpus_type`, `recom_ram`, `recom_ssd`, `recom_price`, `max_perf_vcpus`, `max_perf_vcpus_type`, `max_perf_ram`, `max_perf_ssd`, `max_perf_price`, `step_2_name`, `step_2_description`, `step_2_video_link`, `step_3_name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	2,	1,	101.00,	'8',	'8',	'8',	30.00,	30000.00,	'<p><br></p>',	0,	NULL,	0,	NULL,	'1',	'1',	'10',	'10',	15.00,	'2',	'1',	'50',	'100',	30.00,	'0',	'1',	'0',	'0',	0.00,	NULL,	NULL,	NULL,	NULL,	1,	1,	'2023-07-12 13:59:54',	'2023-07-12 13:59:54',	NULL);

DROP TABLE IF EXISTS `wizard_setting_steps`;
CREATE TABLE `wizard_setting_steps` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `wizard_setting_id` bigint(20) unsigned DEFAULT NULL,
  `project_id` bigint(20) unsigned DEFAULT NULL,
  `step_group` int(11) DEFAULT NULL,
  `field_name` text DEFAULT NULL,
  `field_type` text DEFAULT NULL,
  `field_type_option` text DEFAULT NULL,
  `field_type_logo` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- 2023-07-12 16:28:31