-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Gru 2022, 15:37
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wiacus_biuro`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `konta`
--

CREATE TABLE `konta` (
  `ID` int(11) NOT NULL,
  `login` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `password` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `mail` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `utworzenie_konta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `konta`
--

INSERT INTO `konta` (`ID`, `login`, `password`, `mail`, `utworzenie_konta`) VALUES
(1, 'Jan02', 'pass_123', 'janek.k@test.pl', '2022-11-10'),
(2, 'Kamil', 'secret_123', 'k.kowal@wp.pl', '2020-03-20'),
(4, 'adgor777', 'kocham_gory', 'gory@pasja.com', '2016-05-04'),
(6, 'kam_no1', 'test123', 'kamil@gmail.com', '2022-11-18'),
(18, 'Janek', 'janek123', 'janek@gmail.com', '2022-11-20'),
(19, 'maja', '123', 'maja@git.pl', '2022-11-21'),
(20, 'root', 'root', 'root@root.pl', '2022-09-30');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt`
--

CREATE TABLE `kontakt` (
  `ID` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `nazwisko` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `uwagi` longtext COLLATE utf8_polish_ci NOT NULL,
  `odp` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `kontakt`
--

INSERT INTO `kontakt` (`ID`, `login_id`, `nazwisko`, `mail`, `uwagi`, `odp`) VALUES
(7, 1, 'Kowalski', 'janek.k@test.pl', 'Bardzo ładna strona :P', 0),
(8, 19, 'Nowak', 'maja@git.pl', 'Chcę poinformować że giga mrozi na polku :/', 0),
(9, 4, 'Nowakowski', 'gory@pasja.com', 'Wycieczki z Wami są super!', 1),
(10, 2, 'Wiącek', 'k.kowal@wp.pl', 'Sprawdzam czy działa :P', 1),
(11, 1, 'Kowalski', 'janek.k@test.pl', 'Sprawdzam czy działa strona :o', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oferty`
--

CREATE TABLE `oferty` (
  `ID` int(11) NOT NULL,
  `kierunek` varchar(25) COLLATE utf8mb4_polish_ci NOT NULL,
  `ile_osob` int(11) NOT NULL,
  `ile_dni` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `opis` longtext COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `oferty`
--

INSERT INTO `oferty` (`ID`, `kierunek`, `ile_osob`, `ile_dni`, `cena`, `opis`) VALUES
(1, 'Wlochy', 2, 3, 2000, 'Planujecie wyjazd we dwojga? Jeśli tak, ta oferta jest skierowana właśnie dla Was.\r\nWyjazd w pasmo górskie we Włoszech: Alpy Bergamskie. Celem jest szczyt który znajduję się ponad 2500 m.n.p.m. A dokładnie Pizzo Farno da Valgoglio. Nie czekaj, oferujemy wygodne terminy, planujemy wycieczki w tamtym kierunku już na następny tydzień ale również możecie ustalić znacznie dalszy termin.'),
(2, 'Polska', 5, 4, 630, 'Nie będzie w tym nic odkrywczego, jeżeli powiemy, że góry są najpiękniejsze zimą. Wiedzą o tym wszyscy górscy wędrowcy. Wędrówka przez zaśnieżone polany, przystrojone w biel drzewa, dalekie widoki i to poczucie, że oprócz nas nie ma w górach nikogo… Wielu turystów ma jednak obawy przed wyruszeniem na szlak w warunkach zimowych. W rzeczy samej – samotna wędrówka przez zaśnieżone góry to wyzwanie dla doświadczonych turystów, ale w towarzystwie przewodnika i innych turystów może przerodzić się w piękną przygodę, która na długo zapada w pamięć. Dlaczego by więc nie spróbować? Zapraszamy na weekendowy wypad w polskie góry – będziemy wędrować przez najpiękniejsze polskie pasma górskie, a wieczorem, w schronisku - spędzimy przyjemny wieczór przy gitarze, dobrej muzyce i… w dobrym towarzystwie! Szybko okaże się, że piękne chwile w górach nie muszą oznaczać dalekich i długich wyjazdów. Zapraszamy w Bieszczady w poszukiwaniu zimy w górach!'),
(3, 'Wlochy', 15, 8, 4340, 'Wszystkie wędrówki zaplanowane są w pobliżu morza i wzdłuż wybrzeża, często po prawie nieuczęszczanych, dziewiczych drogach i ścieżkach\r\nMarettimo i Levanzo: dwie, niemal niezamieszkane, najbardziej oddalone i dziewicze wyspy\r\nWidok na morze z każdej strony: zielone rezerwaty zachodniej Sycylii - Zingaro i Monte Cofano\r\nTętniące życiem miasteczka wybrzeża - Trapani i Castellammare del Golfo\r\nFascynujące zetknięcie kultury europejskiej i północnoafrykańskiej\r\nObiad z sycylijską rodziną prowadzącą majątek ziemski'),
(4, 'Wlochy', 15, 9, 2980, 'Całodzienne wycieczki po górach z małym plecakiem\r\nMonte Civetta i jeden z najlepszych widoków w Dolomitach\r\nPale di San Martino – majestatyczny płaskowyż z księżycowym krajobrazem\r\nPark Narodowy Dolomiti Bellunessi - południowe wrota Dolomitów\r\nMasyw Pelmo – skalny olbrzym otoczony łagodnymi trawiastymi wzgórzami\r\nPasso Rolle, Passo Giau, Passo Valles – górskie przełęcze z niesamowitymi widokami\r\nLokalna kuchnia prowincji Belluno\r\nWędrówki w małej grupie'),
(5, 'Gruzja', 8, 7, 2460, 'Megrelska biesiada w wiosce etnograficznej\r\n Swanetia – trekking po jednym z najpiękniejszych regionów górskich Gruzji\r\n Urokliwe kaukaskie wioski z wieżami obronnymi\r\n Regionalna kuchnia swańska i adżarska\r\n Widowiskowe kaniony na rzece Abasha\r\n Batumi - wypoczynek w najpopularniejszym gruzińskim kurorcie'),
(6, 'Gruzja', 7, 9, 2990, 'Trekking w najbogatszym kulturowo regionie Kaukazu\r\n Jeden z najpiękniejszych regionów Kaukazu\r\n Regionalna kuchnia tuszecka na trekkingu\r\n Urokliwe kaukaskie wioski z wieżami obronnymi\r\n Katedra Alaverdi – jeden z najwspanialszych gruzińskich monastyrów\r\n Degustacje kachetyjskich win\r\n Signagi - wizyta w \"mieście miłości\"\r\n Tbilisi – stolica Gruzji'),
(7, 'Szkocja', 2, 8, 3550, 'Błękity jezior, zieleń, szarości i cień - to Góry Szkocji! Góry dzikie, romantyczne, wręcz melancholijne, poetyckie, przesiąknięte krążącymi zewsząd legendami... Góry o krajobrazie zróżnicowanym, niemożliwym do zdefiniowania za pomocą sztywnych ram, jednoznacznych pojęć.\r\nZapraszamy na trekking w Górach Szkocji - nieznanych czy też jeszcze zdecydowanie za mało znanych miłośnikom trekkingu w najciekawszych europejskich destynacjach.'),
(8, 'Szkocja', 8, 8, 6330, 'Ilekroć ktoś opowiada o “najpiękniejszych miejscach na Ziemi” na liście zawsze pojawia się Szkocja. Każdy kto tu był potwierdzi, że zupełnie słusznie. To kraina zielonych wzgórz i gór (samych Munros – szczytów wyższych niż 3000 stóp jest tu ponad 280), urwistych klifów i szerokich, długich dolin. To miejsce, które wygląda jak żywcem wyjęte z baśni. Jeśli więc jeszcze nie byliście w Szkocji to wyprawa ta jest właśnie dla Was!'),
(9, 'Wlochy', 7, 7, 4500, 'Fajna wycieczka w góry, DAWAJ :D');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacje`
--

CREATE TABLE `rezerwacje` (
  `ID` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `nazwisko` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `telefon` int(11) NOT NULL,
  `data` date NOT NULL,
  `ile_dni` int(11) NOT NULL,
  `uwagi` longtext COLLATE utf8_polish_ci NOT NULL,
  `odp` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `rezerwacje`
--

INSERT INTO `rezerwacje` (`ID`, `login_id`, `nazwisko`, `mail`, `telefon`, `data`, `ile_dni`, `uwagi`, `odp`) VALUES
(6, 2, 'Wiącek', 'k.kowal@wp.pl', 543123888, '2022-12-20', 7, '', 1),
(7, 1, 'Kowalski', 'janek.k@test.pl', 999888777, '2023-01-26', 2, 'W Bieszczady, a gdzie :P', 1),
(8, 4, 'Nowakowski', 'gory@pasja.com', 333222333, '2023-06-15', 7, 'Planuję wypad w wakacje do Włoch, co polecacie?', 0),
(9, 1, 'Kowalski', 'janek.k@test.pl', 321123321, '2022-12-15', 7, '', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wiadomosci`
--

CREATE TABLE `wiadomosci` (
  `ID` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `wiadomosc` longtext COLLATE utf8_polish_ci NOT NULL,
  `adnotacja` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `odczytano` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wiadomosci`
--

INSERT INTO `wiadomosci` (`ID`, `login_id`, `wiadomosc`, `adnotacja`, `odczytano`) VALUES
(9, 1, 'Wycieczka zarezerwowana pomyślnie', 'rez', 1),
(10, 4, 'Dzięki, z Tobą również! :D', 'kon', 0),
(11, 2, 'Zarezerwowano pomyślnie', 'rez', 1),
(12, 2, 'Działa, a jak :D', 'kon', 1),
(13, 1, 'Rezerwacja w trakcie realizacji', 'rez', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wpisy_blog`
--

CREATE TABLE `wpisy_blog` (
  `ID` int(11) NOT NULL,
  `konta_id` int(11) NOT NULL,
  `temat` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL,
  `wpis` longtext COLLATE utf8mb4_polish_ci NOT NULL,
  `data_wpisu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- Zrzut danych tabeli `wpisy_blog`
--

INSERT INTO `wpisy_blog` (`ID`, `konta_id`, `temat`, `wpis`, `data_wpisu`) VALUES
(1, 1, 'Wycieczka rodzinna', 'Ostatnio byliśmy z rodziną w Polskich Tatrach, coś pięknego!', '2022-11-09'),
(2, 2, 'Piesza wędrówka', 'Cały wczorajszy dzień spędziłem na wschodniej ścianie Włoskiej, takiej pogody jeszcze nigdy tam nie widziałem!', '2022-11-18'),
(3, 4, 'Biwak pod szczytem', 'W zeszły weekend, dwie noce spędziłem na polu namiotowym pod Pizzo Famo. Pogoda dopisała transport zorganizowany idealnie :D', '2022-11-18'),
(20, 19, 'ja fan', 'giga koks super strona najlepsza wycieczka życia!!!! :D', '2022-11-21'),
(26, 2, 'test', 'test', '2022-12-04');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wpisy_komentarze`
--

CREATE TABLE `wpisy_komentarze` (
  `ID` int(11) NOT NULL,
  `id_wpis` int(11) NOT NULL,
  `login_user` varchar(25) COLLATE utf8_polish_ci NOT NULL,
  `komentarz` longtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `wpisy_komentarze`
--

INSERT INTO `wpisy_komentarze` (`ID`, `id_wpis`, `login_user`, `komentarz`) VALUES
(1, 3, 'Kamil', 'Którędy wchodziłeś ? Zastanawiam się właśnie nad obraniem Pizzo Famo za cel za dwa tygodnie.'),
(2, 3, 'maja', 'Ja osobiście bardzo polecam to miejsce, byłam kiedyś i naprawde jest super!!!'),
(3, 2, 'maja', 'To Ci się poszczęściło, gdy ja tamtędy szłam było trochę gorzej... Ale i tak wspominam jako super wyjazd!'),
(4, 20, 'Jan02', 'Ja też FAN :P'),
(17, 26, 'Jan02', 'dziala\r\n');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `konta`
--
ALTER TABLE `konta`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `oferty`
--
ALTER TABLE `oferty`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wpisy_blog`
--
ALTER TABLE `wpisy_blog`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `wpisy_komentarze`
--
ALTER TABLE `wpisy_komentarze`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `konta`
--
ALTER TABLE `konta`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT dla tabeli `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT dla tabeli `oferty`
--
ALTER TABLE `oferty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `rezerwacje`
--
ALTER TABLE `rezerwacje`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `wiadomosci`
--
ALTER TABLE `wiadomosci`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `wpisy_blog`
--
ALTER TABLE `wpisy_blog`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT dla tabeli `wpisy_komentarze`
--
ALTER TABLE `wpisy_komentarze`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
