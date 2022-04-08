-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 07 Kwi 2022, 22:31
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `tfaktura`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_companies`
--

CREATE TABLE `tfaktura_companies` (
  `id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `nip` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_companies`
--

INSERT INTO `tfaktura_companies` (`id`, `company_name`, `nip`) VALUES
(0, 'TESTOWA Jan Kowalski', '2221136064');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_companies_info`
--

CREATE TABLE `tfaktura_companies_info` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_city` varchar(20) NOT NULL,
  `company_postal_code` varchar(10) NOT NULL,
  `company_street` varchar(50) NOT NULL,
  `company_st_number` varchar(9) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `representative` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_companies_info`
--

INSERT INTO `tfaktura_companies_info` (`id`, `company_id`, `company_city`, `company_postal_code`, `company_street`, `company_st_number`, `phone_number`, `email`, `representative`) VALUES
(0, 0, 'Gdańsk', '04-179', 'Jarzębinowa', '1/2', '123456789', 'kontakt@jankowalski.pl', 'Jan Kowalski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_config`
--

CREATE TABLE `tfaktura_config` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_config`
--

INSERT INTO `tfaktura_config` (`id`, `name`, `value`) VALUES
(0, 'title', 'TFaktura - generator faktur VAT w PDF'),
(1, 'currency_side', 'right'),
(2, 'currency_symbol', 'zł'),
(3, 'charset', 'utf-8'),
(4, 'date_format', 'd-m-Y');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_invoices`
--

CREATE TABLE `tfaktura_invoices` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_data` text NOT NULL,
  `date_of_invoice` date NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `vat_sum` decimal(7,2) NOT NULL,
  `netto_sum` decimal(7,2) NOT NULL,
  `gross_sum` decimal(7,2) NOT NULL,
  `amount_in_words` varchar(155) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `days_to_pay` tinyint(4) NOT NULL,
  `staged` varchar(100) NOT NULL,
  `pickedup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_invoices`
--

INSERT INTO `tfaktura_invoices` (`id`, `buyer_id`, `buyer_data`, `date_of_invoice`, `payment_method`, `vat_sum`, `netto_sum`, `gross_sum`, `amount_in_words`, `notes`, `days_to_pay`, `staged`, `pickedup`) VALUES
(1, 0, 'TESTOWA Jan Kowalski\r\n04-179 Gdańsk, Jarzębinowa 1/2\r\nkontakt@jankowalski.pl\r\nNIP: 2221136064', '2022-02-13', 'Gotówka', '41.40', '180.00', '221.40', 'dwieście dwadzieścia jeden  zł 40/100', 'Fizyczna forma faktury dostępna osobiście.', 0, 'Jan Kowalski', 'Krystian Lemański'),
(2, 0, 'Ewa Lemańska\nPesel: 00000000000\r\n19-200 Grajewo, Pęzy 47\r\newajlemanska@gmail.com', '2022-02-13', 'Przelew', '0.80', '10.00', '10.80', 'dziesięć  zł 80/100', '', 14, 'Jan Kowalski', 'Ewa Lemańska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_invoices_items`
--

CREATE TABLE `tfaktura_invoices_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `unit_quantity` int(11) NOT NULL,
  `measure_unit` varchar(20) NOT NULL,
  `netto_amount` decimal(7,2) NOT NULL,
  `vat` int(11) NOT NULL,
  `vat_amount` decimal(7,2) NOT NULL,
  `gross_amount` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_invoices_items`
--

INSERT INTO `tfaktura_invoices_items` (`id`, `invoice_id`, `item_name`, `unit_quantity`, `measure_unit`, `netto_amount`, `vat`, `vat_amount`, `gross_amount`) VALUES
(1, 1, 'Pizza dla pracowników', 3, 'sztuk', '180.00', 23, '41.40', '221.40'),
(2, 2, 'Karton z Amazonu', 20, 'sztuk', '10.00', 8, '0.80', '10.80');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_proforma`
--

CREATE TABLE `tfaktura_proforma` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `buyer_data` text NOT NULL,
  `date_of_invoice` date NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `vat_sum` decimal(7,2) NOT NULL,
  `netto_sum` decimal(7,2) NOT NULL,
  `gross_sum` decimal(7,2) NOT NULL,
  `amount_in_words` varchar(155) NOT NULL,
  `notes` varchar(200) NOT NULL,
  `days_to_pay` tinyint(4) NOT NULL,
  `staged` varchar(100) NOT NULL,
  `pickedup` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_proforma`
--

INSERT INTO `tfaktura_proforma` (`id`, `buyer_id`, `buyer_data`, `date_of_invoice`, `payment_method`, `vat_sum`, `netto_sum`, `gross_sum`, `amount_in_words`, `notes`, `days_to_pay`, `staged`, `pickedup`) VALUES
(1, 0, 'TESTOWA Jan Kowalski\r\n04-179 Gdańsk, Jarzębinowa 1/2\r\nkontakt@jankowalski.pl\r\nNIP: 2221136064', '2022-02-13', 'Gotówka', '41.40', '180.00', '221.40', 'dwieście dwadzieścia jeden  zł 40/100', 'Fizyczna forma faktury dostępna osobiście.', 0, 'Jan Kowalski', 'Krystian Lemański'),
(2, 0, 'Ewa Lemańska\nPesel: 00000000000\r\n19-200 Grajewo, Pęzy 47\r\newajlemanska@gmail.com', '2022-02-13', 'Przelew', '0.80', '10.00', '10.80', 'dziesięć  zł 80/100', '', 14, 'Jan Kowalski', 'Ewa Lemańska');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_proforma_items`
--

CREATE TABLE `tfaktura_proforma_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `item_name` varchar(150) NOT NULL,
  `unit_quantity` int(11) NOT NULL,
  `measure_unit` varchar(20) NOT NULL,
  `netto_amount` decimal(7,2) NOT NULL,
  `vat` int(11) NOT NULL,
  `vat_amount` decimal(7,2) NOT NULL,
  `gross_amount` decimal(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_proforma_items`
--

INSERT INTO `tfaktura_proforma_items` (`id`, `invoice_id`, `item_name`, `unit_quantity`, `measure_unit`, `netto_amount`, `vat`, `vat_amount`, `gross_amount`) VALUES
(1, 1, 'Pizza dla pracowników', 3, 'sztuk', '180.00', 23, '41.40', '221.40'),
(2, 2, 'Karton z Amazonu', 20, 'sztuk', '10.00', 8, '0.80', '10.80');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_users`
--

CREATE TABLE `tfaktura_users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_users`
--

INSERT INTO `tfaktura_users` (`id`, `login`, `password`, `password_hash`, `email`) VALUES
(0, 'krystian123', '0a5d089ca34585e29927bca603577a96', 'cnJFMFhYWFExR3JKeVE0ZjNETFBIZz09', 'krystian@flovmedia.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tfaktura_users_info`
--

CREATE TABLE `tfaktura_users_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `company_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tfaktura_users_info`
--

INSERT INTO `tfaktura_users_info` (`id`, `user_id`, `name`, `surname`, `phone_number`, `company_id`) VALUES
(0, 0, 'Krystian', 'Lemański', '537490188', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `tfaktura_companies`
--
ALTER TABLE `tfaktura_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_2` (`id`),
  ADD KEY `nip_2` (`nip`);

--
-- Indeksy dla tabeli `tfaktura_companies_info`
--
ALTER TABLE `tfaktura_companies_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `company_id` (`company_id`),
  ADD KEY `id_2` (`id`);

--
-- Indeksy dla tabeli `tfaktura_config`
--
ALTER TABLE `tfaktura_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `id_2` (`id`);

--
-- Indeksy dla tabeli `tfaktura_invoices`
--
ALTER TABLE `tfaktura_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeksy dla tabeli `tfaktura_invoices_items`
--
ALTER TABLE `tfaktura_invoices_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeksy dla tabeli `tfaktura_proforma`
--
ALTER TABLE `tfaktura_proforma`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeksy dla tabeli `tfaktura_proforma_items`
--
ALTER TABLE `tfaktura_proforma_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indeksy dla tabeli `tfaktura_users`
--
ALTER TABLE `tfaktura_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indeksy dla tabeli `tfaktura_users_info`
--
ALTER TABLE `tfaktura_users_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `tfaktura_companies`
--
ALTER TABLE `tfaktura_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `tfaktura_config`
--
ALTER TABLE `tfaktura_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `tfaktura_invoices`
--
ALTER TABLE `tfaktura_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `tfaktura_invoices_items`
--
ALTER TABLE `tfaktura_invoices_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `tfaktura_proforma`
--
ALTER TABLE `tfaktura_proforma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `tfaktura_proforma_items`
--
ALTER TABLE `tfaktura_proforma_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `tfaktura_users`
--
ALTER TABLE `tfaktura_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `tfaktura_companies_info`
--
ALTER TABLE `tfaktura_companies_info`
  ADD CONSTRAINT `tfaktura_companies_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tfaktura_companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tfaktura_invoices_items`
--
ALTER TABLE `tfaktura_invoices_items`
  ADD CONSTRAINT `tfaktura_invoices_items_ibfk_1` FOREIGN KEY (`invoice_id`) REFERENCES `tfaktura_invoices` (`id`);

--
-- Ograniczenia dla tabeli `tfaktura_users_info`
--
ALTER TABLE `tfaktura_users_info`
  ADD CONSTRAINT `tfaktura_users_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tfaktura_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
