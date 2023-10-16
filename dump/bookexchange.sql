-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 16, 2023 alle 13:47
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookexchange`
--
CREATE DATABASE IF NOT EXISTS `bookexchange` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bookexchange`;

-- --------------------------------------------------------

--
-- Struttura della tabella `autore`
--
-- Creazione: Ott 08, 2023 alle 21:22
--

DROP TABLE IF EXISTS `autore`;
CREATE TABLE `autore` (
  `id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `autore`:
--

--
-- Dump dei dati per la tabella `autore`
--

INSERT IGNORE INTO `autore` (`id`) VALUES
(' Guido Schneider'),
('A. Paola Ercolani'),
('Adam Allsuch Boardman'),
('Alan Cowsill'),
('Alessandra Areni'),
('Alessandro Rubini'),
('Alex Irvine'),
('Alfio Quarteroni'),
('Andi Gutmans'),
('Andrea Camilleri'),
('Andrew S. Tanenbaum'),
('Anthony Bulger'),
('Anthony Reynolds'),
('Bartosz Sztybor'),
('Brian Michael Bendis'),
('Camil Demetrescu'),
('Camilla Saly-Monzingo'),
('Carlo D. Pagani'),
('Carlo Domenico Pagani'),
('Carlo Petronio'),
('Cetta Brancato'),
('Claudio Luchinat'),
('Cristiana Larizza'),
('Daniel Wallace'),
('Dante Alighieri'),
('Dario E. Aguiari'),
('David Holmes (informatico.)'),
('Derick Rethans'),
('Fabrizio Mani'),
('Fausto Saleri'),
('Frances Hardinge'),
('Francesco Pauli'),
('Geronimo Stilton'),
('Giampaolo Cicogna'),
('Gina Shaw'),
('Giovanni Battista Cotta'),
('Giulia Brusco'),
('Giuseppe De Marco'),
('Giuseppe F. Italiano'),
('Giuseppe Nardulli'),
('Giuseppe Psaila'),
('Hannes Uecker'),
('Hidenori Kusaka'),
('Iela Mari'),
('iop'),
('Irene Finocchi'),
('Ivano Bertini'),
('J. E EDITOR MARSDEN'),
('James Gosling'),
('Jesús Hervás'),
('Ken Arnold'),
('Luisa Perotti'),
('Maarten Van Steen'),
('Marco Bramanti'),
('Marlene Clapp'),
('Matilde Trevisani'),
('Matteo Salvo'),
('Matthew K. Manning'),
('Melanie Scott'),
('Michael Eugene Taylor'),
('Michael McAvennie'),
('Monica Conti'),
('Nader Butto'),
('Nancy Conner'),
('Neil deGrasse Tyson'),
('Nick Snels'),
('Nicola Torelli'),
('P M Suski'),
('Paola Gervasio'),
('Paolo Atzeni'),
('Paolo Corazzon'),
('Pasquale Cioffi'),
('Paul Wellens'),
('Piero Fraternali'),
('Riccardo Sacco'),
('Riccardo Torlone'),
('Rita Bressan'),
('Robert Spector'),
('Roger K. Leir'),
('Roland Barthes'),
('Romano Fantacci'),
('S. Speroni Zagrljaca'),
('Sal Esmeralda'),
('Salvatore Conte'),
('Sandro Salsa'),
('Sara Pichelli'),
('Satoshi Yamamoto'),
('Saverio Rubini'),
('Scholastic'),
('Silvia Fernández'),
('Simone Venturini'),
('Stefano Bertocchi'),
('Stefano Ceri'),
('Stefano Paraboschi'),
('Stephen Gasiorowicz'),
('Stephen King'),
('Stephen W. Hawking'),
('Stig Bakken'),
('Tommaso Ariemma'),
('Tullio Facchinetti'),
('Vincenzo Cinanni'),
('Virgilio Malvezzi'),
('Vittorio Moriggia'),
('Vivina Laura Barutello'),
('Who HQ'),
('William Gibson'),
('William Shakespeare');

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--
-- Creazione: Ott 13, 2023 alle 10:31
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `categoria` varchar(50) NOT NULL,
  `libro` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `categoria`:
--   `libro`
--       `libro` -> `id`
--

--
-- Dump dei dati per la tabella `categoria`
--

INSERT IGNORE INTO `categoria` (`categoria`, `libro`) VALUES
('Art', 'o0wAEAAAQBAJ'),
('Body, Mind & Spirit', 'MheREAAAQBAJ'),
('Body, Mind & Spirit', 'wZW8zlgdSKQC'),
('Business & Economics', '-3ccLlxnJTQC'),
('Comics & Graphic Novels', '0vKiDwAAQBAJ'),
('Comics & Graphic Novels', 'gLeSAQAACAAJ'),
('Comics & Graphic Novels', 'H-v2DwAAQBAJ'),
('Comics & Graphic Novels', 'h3GyEAAAQBAJ'),
('Comics & Graphic Novels', 'VlQMMQAACAAJ'),
('Computers', '3RQOMzB5DboC'),
('Computers', 'aGPpKiMfcxsC'),
('Computers', 'b4gxPQAACAAJ'),
('Computers', 'gyqFPQAACAAJ'),
('Computers', 'K-9ZrgEACAAJ'),
('Computers', 'mSpXfV15GPgC'),
('Computers', 'SZtsFe66zucC'),
('Computers', 'uhrblChZ5_wC'),
('Computers', 'ULRJCgAAQBAJ'),
('Computers', 'Vpl86eYrBVMC'),
('Differential equations, Nonlinear', '3Z87DwAAQBAJ'),
('Differential equations, Partial', 'KduhuwEACAAJ'),
('Drama', 'yCeGJKSIZkYC'),
('Fantasy', 'gWqWtgAACAAJ'),
('Fiction', '4VYQswEACAAJ'),
('Fiction', '8VnJLu3AvvQC'),
('Fiction', 'CpasBAAAQBAJ'),
('Fiction', 'HVWGEAAAQBAJ'),
('Fiction', 'neGMDwAAQBAJ'),
('Fiction', 'S6TOxwEACAAJ'),
('Fiction', 'tEsoDQAAQBAJ'),
('Games', '4ErGAwAAQBAJ'),
('Games', 'nOnvDwAAQBAJ'),
('Games & Activities', 'BoDXzwEACAAJ'),
('Games & Activities', 'i98sEAAAQBAJ'),
('Games & Activities', 'VhfYywEACAAJ'),
('Juvenile Fiction', 'GoLMDAAAQBAJ'),
('Juvenile Fiction', 'y9ibDwAAQBAJ'),
('Juvenile Nonfiction', 'Dw7fDwAAQBAJ'),
('Juvenile Nonfiction', 'JCmyuYuXM-sC'),
('Juvenile Nonfiction', 'r2P8DwAAQBAJ'),
('Language Arts & Disciplines', '6HaiDwAAQBAJ'),
('Language Arts & Disciplines', 'jR33FtEh71kC'),
('Language Arts & Disciplines', 'WZj-swEACAAJ'),
('Literary Collections', '9DuiAwAAQBAJ'),
('Literary Criticism', 'ETSNu0mDMRcC'),
('Matematica', 'K9g_BAAAQBAJ'),
('Mathematics', '4MfUAgAAQBAJ'),
('Mathematics', '4VGFoAEACAAJ'),
('Mathematics', 'bftyCgAAQBAJ'),
('Mathematics', 'Bq4hQAAACAAJ'),
('Mathematics', 'ebi3PAAACAAJ'),
('Mathematics', 'K9g_BAAAQBAJ'),
('Mathematics', 'MbcnAAAACAAJ'),
('Mathematics', 'PmKkOnn2SyIC'),
('Medical', 'BTZJsTU6DLgC'),
('Medical', 'W3SWAAAACAAJ'),
('Operas', '4bs2AQAAIAAJ'),
('Photography', '2HkTAAAACAAJ'),
('Psychology', 'FsTIAAAACAAJ'),
('Religion', 'W5Cy5ozqh34C'),
('Science', '-R106Urv198C'),
('Science', '7gvZoAEACAAJ'),
('Science', 'fcHjh8jIeGkC'),
('Science', 'hx5DDQAAQBAJ'),
('Science', 'lEt_1qjW4vAC'),
('Science', 'NADCXwAACAAJ'),
('Science', 'NXMtCwAAQBAJ'),
('Technology & Engineering', 'nOnvDwAAQBAJ'),
('Trees', 'Y3NlAgAACAAJ'),
('Universita', 'K9g_BAAAQBAJ');

-- --------------------------------------------------------

--
-- Struttura della tabella `conversazione`
--
-- Creazione: Ott 08, 2023 alle 21:22
--

DROP TABLE IF EXISTS `conversazione`;
CREATE TABLE `conversazione` (
  `id` int(11) NOT NULL,
  `utente1` int(11) DEFAULT NULL,
  `utente2` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `conversazione`:
--   `utente1`
--       `utente` -> `id`
--   `utente2`
--       `utente` -> `id`
--

--
-- Dump dei dati per la tabella `conversazione`
--

INSERT IGNORE INTO `conversazione` (`id`, `utente1`, `utente2`) VALUES
(15, 30, 23),
(16, 29, 23),
(17, 31, 29),
(18, 23, 32);

-- --------------------------------------------------------

--
-- Struttura della tabella `libro`
--
-- Creazione: Ott 08, 2023 alle 21:22
--

DROP TABLE IF EXISTS `libro`;
CREATE TABLE `libro` (
  `id` varchar(128) NOT NULL,
  `titolo` varchar(100) NOT NULL,
  `editore` varchar(100) NOT NULL,
  `copertina` varchar(256) DEFAULT '/bookexchange/imgs/bookcovers/default-book-cover.jpg',
  `anno` smallint(6) DEFAULT NULL,
  `lingua` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `libro`:
--

--
-- Dump dei dati per la tabella `libro`
--

INSERT IGNORE INTO `libro` (`id`, `titolo`, `editore`, `copertina`, `anno`, `lingua`) VALUES
('-3ccLlxnJTQC', 'Amazon.com. Get big fast. Viaggio all\'interno di un rivoluzionario m odello di mercato che ha cambia', 'Fazi Editore', 'http://books.google.com/books/content?id=-3ccLlxnJTQC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2001, 'it'),
('-R106Urv198C', 'Fisica 1', 'Alpha Test', 'http://books.google.com/books/content?id=-R106Urv198C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1999, 'it'),
('0vKiDwAAQBAJ', 'DC Comics Year By Year New Edition', 'Dorling Kindersley Ltd', 'http://books.google.com/books/content?id=0vKiDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2019, 'en'),
('2HkTAAAACAAJ', 'La camera chiara. Nota sulla fotografia', 'undefined', 'http://books.google.com/books/content?id=2HkTAAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2003, 'it'),
('3RQOMzB5DboC', 'PHP 5 - Guida completa', 'Apogeo Editore', '/bookexchange/imgs/bookcovers/3RQOMzB5DboCcopertina.jpg', 2005, 'it'),
('3Z87DwAAQBAJ', 'Nonlinear PDEs: A Dynamical Systems Approach', 'American Mathematical Soc.', 'http://books.google.com/books/content?id=3Z87DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2017, 'en'),
('4bs2AQAAIAAJ', 'Amori d\'Apollo e di Dafne. Italian', 'undefined', 'http://books.google.com/books/content?id=4bs2AQAAIAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 1983, 'it'),
('4ErGAwAAQBAJ', 'La magia del Poker - Tutti i segreti per vincere a texas Hold’em e alle altre varianti del gioco più', 'SEM - Servizi Editoriali & Multimediali', 'http://books.google.com/books/content?id=4ErGAwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2011, 'it'),
('4MfUAgAAQBAJ', 'Analisi 2', 'Lampi di stampa', 'http://books.google.com/books/content?id=4MfUAgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1999, 'it'),
('4VGFoAEACAAJ', 'Matematica Numerica', 'Springer', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2014, 'it'),
('4VYQswEACAAJ', 'Mai stata al mondo', 'undefined', 'http://books.google.com/books/content?id=4VYQswEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2015, 'it'),
('6HaiDwAAQBAJ', 'Psicologia della comunicazione', 'libreriauniversitaria.it Edizioni', 'http://books.google.com/books/content?id=6HaiDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2019, 'it'),
('7gvZoAEACAAJ', 'Metodi matematici della Fisica', 'Springer', 'http://books.google.com/books/content?id=7gvZoAEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2014, 'it'),
('8VnJLu3AvvQC', 'The Shining', 'Anchor', 'http://books.google.com/books/content?id=8VnJLu3AvvQC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2008, 'en'),
('9DuiAwAAQBAJ', 'The Phonetics of Japanese Language', 'Routledge', 'http://books.google.com/books/content?id=9DuiAwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2010, 'en'),
('aGPpKiMfcxsC', 'JavaScript', 'Apogeo Editore', 'http://books.google.com/books/content?id=aGPpKiMfcxsC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2004, 'it'),
('b4gxPQAACAAJ', 'Algoritmi e strutture dati', 'McGraw-Hill Education', 'http://books.google.com/books/content?id=b4gxPQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2004, 'it'),
('bftyCgAAQBAJ', 'Geometria e Algebra Lineare', 'Società Editrice Esculapio', '/bookexchange/imgs/bookcovers/bftyCgAAQBAJcopertina.', 2015, 'it'),
('BoDXzwEACAAJ', 'Filosofia del gaming. Da Talete alla PlayStation', 'undefined', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2023, 'it'),
('Bq4hQAAACAAJ', 'Analisi matematica 2', 'undefined', 'http://books.google.com/books/content?id=Bq4hQAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2009, 'it'),
('BSVBBAAAQBAJ', 'Quesiti di chimica', 'Società Editrice Esculapio', '', 2011, 'it'),
('BTZJsTU6DLgC', 'Medicina universale e il settimo senso', 'Edizioni Mediterranee', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2004, 'it'),
('C6giBAAAQBAJ', 'Fondamenti di Meccanica', 'Società Editrice Esculapio', '', 1997, 'it'),
('CNk_BAAAQBAJ', 'Statistica per le analisi economico-aziendali', 'Maggioli Editore', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2010, 'it'),
('CpasBAAAQBAJ', 'La notte che bruciammo Chrome', 'Edizioni Mondadori', 'http://books.google.com/books/content?id=CpasBAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2014, 'it'),
('Dw7fDwAAQBAJ', 'What Is Nintendo?', 'Penguin', 'http://books.google.com/books/content?id=Dw7fDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2021, 'en'),
('ebi3PAAACAAJ', 'Analisi matematica 1', 'undefined', 'http://books.google.com/books/content?id=ebi3PAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2008, 'it'),
('elNMAAAAcAAJ', 'Vita prodigiosa del B. Andrea da Montereale', 'undefined', 'http://books.google.com/books/content?id=elNMAAAAcAAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1726, 'it'),
('ETSNu0mDMRcC', 'Letteratura Russa', 'Alpha Test', 'http://books.google.com/books/content?id=ETSNu0mDMRcC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2003, 'it'),
('fcHjh8jIeGkC', 'Meccanica quantistica', 'FrancoAngeli', 'http://books.google.com/books/content?id=fcHjh8jIeGkC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2001, 'it'),
('FsTIAAAACAAJ', 'Problemi risolti di statistica applicata alla psicologia', 'undefined', '/bookexchange/imgs/bookcovers/FsTIAAAACAAJcopertina.', 1999, 'it'),
('gLeSAQAACAAJ', 'Pokemon. La grande avventura', 'undefined', 'http://books.google.com/books/content?id=gLeSAQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2017, 'it'),
('GoLMDAAAQBAJ', 'L\'albero delle bugie', 'Edizioni Mondadori', 'http://books.google.com/books/content?id=GoLMDAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2016, 'it'),
('gWqWtgAACAAJ', 'Il giardino segreto di Frances Hodgson Burnett', 'Grandi storie', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2012, 'it'),
('gyqFPQAACAAJ', 'Basi di dati. Architetture e linee di evoluzione', 'McGraw-Hill Education', 'http://books.google.com/books/content?id=gyqFPQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2007, 'it'),
('H-v2DwAAQBAJ', 'Marvel Must-Have: Ultimate Comics Spider-Man - Chi è Miles Morales?', 'Panini S.p.A.', 'http://books.google.com/books/content?id=H-v2DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2020, 'it'),
('h3GyEAAAQBAJ', 'Cyberpunk 2077 - Hai la mia parola', 'Panini S.p.A.', 'http://books.google.com/books/content?id=h3GyEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2023, 'it'),
('HVWGEAAAQBAJ', 'Ruination: Un romanzo di League of Legends', 'Editrice Nord', 'http://books.google.com/books/content?id=HVWGEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2022, 'it'),
('hx5DDQAAQBAJ', 'Astrophysics for People in a Hurry', 'W. W. Norton & Company', 'http://books.google.com/books/content?id=hx5DDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2017, 'en'),
('i98sEAAAQBAJ', 'Gatti Carini Libro da Colorare per Bambini 1', 'ColoringArtist.com', 'http://books.google.com/books/content?id=i98sEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2021, 'it'),
('JCmyuYuXM-sC', 'La divina commedia', 'HOEPLI EDITORE', 'http://books.google.com/books/content?id=JCmyuYuXM-sC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 1985, 'it'),
('jR33FtEh71kC', 'Impara l\'inglese in un mese', 'Edizioni Gribaudo', 'http://books.google.com/books/content?id=jR33FtEh71kC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2011, 'it'),
('K-9ZrgEACAAJ', 'Programmare in C. Concetti di base e tecniche avanzate', 'undefined', 'http://books.google.com/books/content?id=K-9ZrgEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2015, 'it'),
('K9g_BAAAQBAJ', 'Analisi matematica. Dal calcolo all\'analisi', 'Maggioli Editore', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2006, 'it'),
('KduhuwEACAAJ', 'Partial Differential Equations', 'undefined', 'http://books.google.com/books/content?id=KduhuwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 1996, 'en'),
('lEt_1qjW4vAC', 'Dal big bang ai buchi neri', 'Bur', 'http://books.google.com/books/content?id=lEt_1qjW4vAC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2011, 'it'),
('LXA5VzAKY98C', 'The Great Pika Pie Caper', 'Lulu.com', 'http://books.google.com/books/content?id=LXA5VzAKY98C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2008, 'en'),
('MbcnAAAACAAJ', 'Matematica. Per i diplomi universitari', 'undefined', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 1997, 'it'),
('MheREAAAQBAJ', 'An Illustrated History of UFOs', 'National Geographic Books', 'http://books.google.com/books/content?id=MheREAAAQBAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2020, 'en'),
('mSpXfV15GPgC', 'Concetti fondamentali di informatica', 'undefined', 'http://books.google.com/books/content?id=mSpXfV15GPgC&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2007, 'it'),
('NADCXwAACAAJ', 'Chimica', 'undefined', 'http://books.google.com/books/content?id=NADCXwAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2011, 'it'),
('neGMDwAAQBAJ', 'Km 123', 'Edizioni Mondadori', 'http://books.google.com/books/content?id=neGMDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2019, 'it'),
('nOnvDwAAQBAJ', 'Sistemi a coda. Modelli Analisi e Applicazioni', 'Società Editrice Esculapio', 'http://books.google.com/books/content?id=nOnvDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2020, 'it'),
('NXMtCwAAQBAJ', 'Quantum Physics', 'John Wiley & Sons', 'http://books.google.com/books/content?id=NXMtCwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2003, 'en'),
('o0wAEAAAQBAJ', 'Horror italiano', 'Donzelli Editore', 'http://books.google.com/books/content?id=o0wAEAAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2005, 'it'),
('OdfjCgAAQBAJ', 'Meccanica Razionale', 'Springer', '', 2015, 'it'),
('PmKkOnn2SyIC', 'Statistica: esercizi ed esempi', 'Pearson Italia S.p.a.', 'http://books.google.com/books/content?id=PmKkOnn2SyIC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2008, 'it'),
('r2P8DwAAQBAJ', 'Hello, World! - Le cronache di un Lockdown', 'Youcanprint', 'http://books.google.com/books/content?id=r2P8DwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2020, 'it'),
('S6TOxwEACAAJ', 'It', 'undefined', 'http://books.google.com/books/content?id=S6TOxwEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2019, 'it'),
('SZtsFe66zucC', 'Google Apps: The Missing Manual', '\"O\'Reilly Media, Inc.\"', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2008, 'en'),
('tEsoDQAAQBAJ', 'The Morris-Jumel Mansion Anthology of Fantasy and Paranormal Ficiton', 'Riverdale Avenue Books LLC', 'http://books.google.com/books/content?id=tEsoDQAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2016, 'en'),
('uhrblChZ5_wC', 'Sistemi distribuiti. Principi e paradigmi', 'Pearson Italia S.p.a.', 'http://books.google.com/books/content?id=uhrblChZ5_wC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2007, 'it'),
('ULRJCgAAQBAJ', 'Practical Web Development', 'Packt Publishing Ltd', 'http://books.google.com/books/content?id=ULRJCgAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2015, 'en'),
('VhfYywEACAAJ', 'Zelda. Dietro la leggenda', 'undefined', 'http://books.google.com/books/content?id=VhfYywEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2019, 'it'),
('VlQMMQAACAAJ', 'Pokemon. La grande avventura', 'undefined', 'http://books.google.com/books/content?id=VlQMMQAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2016, 'it'),
('Vpl86eYrBVMC', 'Il linguaggio Java. Manuale ufficiale', 'Pearson Italia S.p.a.', '/bookexchange/imgs/bookcovers/default-book-cover.jpg', 2006, 'it'),
('W3SWAAAACAAJ', 'Cani e gatti in erboristeria', 'undefined', 'http://books.google.com/books/content?id=W3SWAAAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2006, 'it'),
('W5Cy5ozqh34C', 'I grandi misteri irrisolti della Chiesa', 'Newton Compton Editori', 'http://books.google.com/books/content?id=W5Cy5ozqh34C&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2012, 'it'),
('WZj-swEACAAJ', 'Perfezionamento dell\'inglese', 'Perfezionamenti', 'http://books.google.com/books/content?id=WZj-swEACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2017, 'it'),
('wZW8zlgdSKQC', 'The Aliens and the Scalpel', 'Book Tree', 'http://books.google.com/books/content?id=wZW8zlgdSKQC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2005, 'en'),
('Y3NlAgAACAAJ', 'L\'albero', 'undefined', 'http://books.google.com/books/content?id=Y3NlAgAACAAJ&printsec=frontcover&img=1&zoom=1&source=gbs_api', 2008, 'it'),
('y9ibDwAAQBAJ', 'Esports: The Ultimate Guide', 'Scholastic Inc.', 'http://books.google.com/books/content?id=y9ibDwAAQBAJ&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2019, 'en'),
('yCeGJKSIZkYC', 'The Taming of the Shrew', 'Cambridge University Press', 'http://books.google.com/books/content?id=yCeGJKSIZkYC&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api', 2002, 'en');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggio`
--
-- Creazione: Ott 08, 2023 alle 21:22
--

DROP TABLE IF EXISTS `messaggio`;
CREATE TABLE `messaggio` (
  `id` int(11) NOT NULL,
  `conversazione` int(11) NOT NULL,
  `mittente` int(11) NOT NULL,
  `destinatario` int(11) NOT NULL,
  `messaggio` varchar(512) NOT NULL,
  `data_creazione` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `messaggio`:
--   `conversazione`
--       `conversazione` -> `id`
--   `mittente`
--       `utente` -> `id`
--   `destinatario`
--       `utente` -> `id`
--

--
-- Dump dei dati per la tabella `messaggio`
--

INSERT IGNORE INTO `messaggio` (`id`, `conversazione`, `mittente`, `destinatario`, `messaggio`, `data_creazione`) VALUES
(98, 15, 23, 30, 'ciao', '2023-10-07 01:06:03'),
(99, 15, 23, 30, 'ciao', '2023-10-07 01:06:24'),
(100, 15, 30, 23, 'come stai? 🤬', '2023-10-07 01:13:01'),
(101, 15, 23, 30, 'hello', '2023-10-07 01:49:44'),
(102, 15, 23, 30, 'aaaaaaaaaaaaaaaaaaaaaaaaasdfsd sdfsa dfsdaf sadfh suadhfuaish fashdfu hsadufhu isadhfushdaufh saiudfhu sahdfuihasdufi hasudfhasiuhfasdiufh', '2023-10-07 02:07:04'),
(103, 15, 23, 30, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2023-10-07 02:10:44'),
(104, 15, 23, 30, 'ciao', '2023-10-07 02:11:17'),
(105, 15, 23, 30, 'allora poi come è andata ieri sera? sei riuscito a prendere quel libro?', '2023-10-07 02:12:33'),
(106, 16, 23, 29, 'hey come stai? hai visto il libro?', '2023-10-07 09:49:18'),
(107, 16, 29, 23, 'si grazie, mi sta piacendo molto! 👍', '2023-10-08 18:16:43'),
(108, 16, 23, 29, 'Mi fa piacere 😁, buona lettura 👍!', '2023-10-08 23:49:02'),
(109, 17, 31, 29, 'ciao!', '2023-10-09 10:30:02'),
(110, 16, 29, 23, 'a', '2023-10-09 22:23:32'),
(111, 16, 29, 23, 'a', '2023-10-09 22:26:19'),
(112, 16, 29, 23, 'a', '2023-10-09 22:36:32'),
(113, 16, 29, 23, 'aaa', '2023-10-09 22:36:39'),
(114, 16, 29, 23, 'buongiono', '2023-10-10 10:01:48'),
(115, 16, 29, 23, 'come va?', '2023-10-10 10:01:55'),
(116, 16, 29, 23, 'hello?', '2023-10-10 10:24:55'),
(117, 16, 29, 23, 'hello', '2023-10-10 10:25:03'),
(118, 16, 29, 23, 'helo', '2023-10-10 10:25:23'),
(119, 16, 29, 23, 'a', '2023-10-10 10:26:10'),
(120, 16, 29, 23, 'aaa', '2023-10-10 10:26:26'),
(121, 17, 29, 31, 'ciao', '2023-10-10 10:27:03'),
(122, 16, 29, 23, 'ciaooo', '2023-10-10 10:27:08'),
(123, 16, 29, 23, 'ciaaaoaaooo', '2023-10-10 10:28:49'),
(124, 16, 29, 23, 'ciao', '2023-10-10 10:29:43'),
(125, 16, 29, 23, 'hello', '2023-10-10 10:34:59'),
(126, 16, 29, 23, 'hello', '2023-10-10 10:35:20'),
(127, 16, 29, 23, 'ciao', '2023-10-10 10:39:10'),
(128, 16, 29, 23, 'ciao', '2023-10-10 10:39:33'),
(129, 16, 29, 23, 'ciao', '2023-10-10 10:40:19'),
(130, 16, 29, 23, 'hello', '2023-10-10 10:41:25'),
(131, 16, 29, 23, 'ciao', '2023-10-10 10:41:47'),
(132, 16, 29, 23, 'ciao', '2023-10-10 10:43:13'),
(133, 16, 29, 23, 'bai', '2023-10-10 10:45:05'),
(134, 16, 29, 23, 'asssas', '2023-10-10 10:46:21'),
(135, 16, 29, 23, 'asdasd', '2023-10-10 10:47:04'),
(136, 16, 29, 23, 'jaloo', '2023-10-10 10:47:28'),
(137, 16, 29, 23, 'sadasd', '2023-10-10 10:48:00'),
(138, 16, 29, 23, 'asdada', '2023-10-10 10:49:00'),
(139, 16, 23, 29, 'hello perchè spammi?', '2023-10-12 20:36:20'),
(140, 16, 29, 23, 'non lo so 🙄', '2023-10-12 20:37:05'),
(141, 18, 23, 32, 'Ciao ALE!', '2023-10-12 22:19:34'),
(142, 18, 32, 23, 'OH WOW', '2023-10-12 22:20:06'),
(143, 18, 32, 23, 'Ma tu puoi vedere mail e password che ho inserito giusto', '2023-10-12 22:20:27'),
(144, 18, 23, 32, 'solo la mail', '2023-10-12 22:20:48'),
(145, 18, 23, 32, 'la password è criptata', '2023-10-12 22:20:52'),
(146, 18, 32, 23, 'Addirittura ', '2023-10-12 22:21:08'),
(147, 18, 23, 32, 'yes', '2023-10-12 22:21:14'),
(148, 18, 23, 32, 'standard', '2023-10-12 22:21:15'),
(149, 18, 32, 23, 'Devo refreshare per le risposte?...', '2023-10-12 22:21:33'),
(150, 18, 23, 32, 'puoi vedere i dati del tuo profilo andando al sito ', '2023-10-12 22:21:44'),
(151, 18, 23, 32, 'http://79.23.30.58:8080/bookexchange/api.php/user/32', '2023-10-12 22:21:53'),
(152, 18, 23, 32, 'yes ale, le chat in tempo reali sono difficili', '2023-10-12 22:22:03'),
(153, 18, 23, 32, 'dovrei creare una websocket per avere la chat in tempo reale, è un casino', '2023-10-12 22:22:46'),
(154, 15, 30, 23, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2023-10-13 12:36:20');

-- --------------------------------------------------------

--
-- Struttura della tabella `possesso`
--
-- Creazione: Ott 13, 2023 alle 10:48
-- Ultimo aggiornamento: Ott 16, 2023 alle 11:45
--

DROP TABLE IF EXISTS `possesso`;
CREATE TABLE `possesso` (
  `proprietario` int(11) NOT NULL,
  `libro` varchar(128) NOT NULL,
  `descrizione` varchar(200) DEFAULT '''''',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `possesso`:
--   `proprietario`
--       `utente` -> `id`
--   `libro`
--       `libro` -> `id`
--

--
-- Dump dei dati per la tabella `possesso`
--

INSERT IGNORE INTO `possesso` (`proprietario`, `libro`, `descrizione`, `id`) VALUES
(33, 'gyqFPQAACAAJ', '', 1),
(29, 'ebi3PAAACAAJ', 'il mio vecchio libro di analisi', 2),
(29, 'uhrblChZ5_wC', '', 4),
(29, 'K9g_BAAAQBAJ', '', 6),
(29, 'NXMtCwAAQBAJ', '', 7),
(29, 'K-9ZrgEACAAJ', '', 8),
(23, 'mSpXfV15GPgC', '', 9),
(33, 'ETSNu0mDMRcC', '', 10),
(23, 'WZj-swEACAAJ', '', 11),
(23, 'JCmyuYuXM-sC', '', 12),
(30, 'gLeSAQAACAAJ', '', 13),
(30, 'Dw7fDwAAQBAJ', '', 14),
(23, 'VhfYywEACAAJ', '', 15),
(29, 'VlQMMQAACAAJ', '', 16),
(23, '4ErGAwAAQBAJ', 'poker la magia wow', 17),
(29, '6HaiDwAAQBAJ', '', 18),
(29, 'GoLMDAAAQBAJ', '', 19),
(23, 'tEsoDQAAQBAJ', '', 20),
(29, 'aGPpKiMfcxsC', '', 21),
(29, 'aGPpKiMfcxsC', 'vecchio libro', 22),
(23, 'o0wAEAAAQBAJ', '', 23),
(29, 'W5Cy5ozqh34C', 'aaaaa simone', 24),
(29, 'Vpl86eYrBVMC', 'aaa aggiunto', 26),
(29, 'yCeGJKSIZkYC', 'il mio shakespeare', 27),
(29, 'HVWGEAAAQBAJ', 'lol', 28),
(30, 'MbcnAAAACAAJ', '', 29),
(29, 'hx5DDQAAQBAJ', '', 30),
(29, 'lEt_1qjW4vAC', '', 31),
(29, '2HkTAAAACAAJ', 'il mio vecchio libro di fotografia', 32),
(32, '4ErGAwAAQBAJ', '', 33),
(23, 'wZW8zlgdSKQC', '', 34),
(23, 'MheREAAAQBAJ', '', 35),
(30, 'KduhuwEACAAJ', '', 37),
(30, 'H-v2DwAAQBAJ', '', 38),
(30, '0vKiDwAAQBAJ', '', 39),
(23, 'nOnvDwAAQBAJ', '', 41);

-- --------------------------------------------------------

--
-- Struttura della tabella `scambio`
--
-- Creazione: Ott 16, 2023 alle 11:41
-- Ultimo aggiornamento: Ott 16, 2023 alle 11:45
--

DROP TABLE IF EXISTS `scambio`;
CREATE TABLE `scambio` (
  `id` int(11) NOT NULL,
  `stato` varchar(10) DEFAULT 'pending',
  `data_creazione` datetime DEFAULT current_timestamp(),
  `proposta` int(11) DEFAULT NULL,
  `offerta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `scambio`:
--   `proposta`
--       `possesso` -> `id`
--   `offerta`
--       `possesso` -> `id`
--

--
-- Dump dei dati per la tabella `scambio`
--

INSERT IGNORE INTO `scambio` (`id`, `stato`, `data_creazione`, `proposta`, `offerta`) VALUES
(80, 'cancelled', '2023-10-13 13:10:17', 35, 31),
(81, 'cancelled', '2023-10-13 13:45:00', 23, 32),
(85, 'accepted', '2023-10-13 14:17:12', 35, 10),
(91, 'accepted', '2023-10-13 14:50:38', 34, 29),
(92, 'refused', '2023-10-13 14:52:53', 39, 34),
(95, 'pending', '2023-10-13 14:58:38', 12, 30);

-- --------------------------------------------------------

--
-- Struttura della tabella `scrittura`
--
-- Creazione: Ott 08, 2023 alle 21:22
--

DROP TABLE IF EXISTS `scrittura`;
CREATE TABLE `scrittura` (
  `autore` varchar(100) NOT NULL,
  `libro` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `scrittura`:
--   `autore`
--       `autore` -> `id`
--   `libro`
--       `libro` -> `id`
--

--
-- Dump dei dati per la tabella `scrittura`
--

INSERT IGNORE INTO `scrittura` (`autore`, `libro`) VALUES
(' Guido Schneider', '3Z87DwAAQBAJ'),
('A. Paola Ercolani', 'FsTIAAAACAAJ'),
('Adam Allsuch Boardman', 'MheREAAAQBAJ'),
('Alan Cowsill', '0vKiDwAAQBAJ'),
('Alessandra Areni', 'FsTIAAAACAAJ'),
('Alessandro Rubini', 'K-9ZrgEACAAJ'),
('Alex Irvine', '0vKiDwAAQBAJ'),
('Alfio Quarteroni', '4VGFoAEACAAJ'),
('Andi Gutmans', '3RQOMzB5DboC'),
('Andrea Camilleri', 'neGMDwAAQBAJ'),
('Andrew S. Tanenbaum', 'uhrblChZ5_wC'),
('Anthony Bulger', 'WZj-swEACAAJ'),
('Anthony Reynolds', 'HVWGEAAAQBAJ'),
('Bartosz Sztybor', 'h3GyEAAAQBAJ'),
('Brian Michael Bendis', 'H-v2DwAAQBAJ'),
('Camil Demetrescu', 'b4gxPQAACAAJ'),
('Camilla Saly-Monzingo', 'tEsoDQAAQBAJ'),
('Carlo D. Pagani', 'Bq4hQAAACAAJ'),
('Carlo D. Pagani', 'ebi3PAAACAAJ'),
('Carlo Domenico Pagani', 'MbcnAAAACAAJ'),
('Carlo Petronio', 'bftyCgAAQBAJ'),
('Cetta Brancato', '4VYQswEACAAJ'),
('Claudio Luchinat', 'NADCXwAACAAJ'),
('Cristiana Larizza', 'K-9ZrgEACAAJ'),
('Daniel Wallace', '0vKiDwAAQBAJ'),
('Dante Alighieri', 'JCmyuYuXM-sC'),
('Dario E. Aguiari', 'W3SWAAAACAAJ'),
('David Holmes (informatico.)', 'Vpl86eYrBVMC'),
('Derick Rethans', '3RQOMzB5DboC'),
('Fabrizio Mani', 'NADCXwAACAAJ'),
('Fausto Saleri', '4VGFoAEACAAJ'),
('Frances Hardinge', 'GoLMDAAAQBAJ'),
('Francesco Pauli', 'PmKkOnn2SyIC'),
('Geronimo Stilton', 'gWqWtgAACAAJ'),
('Giampaolo Cicogna', '7gvZoAEACAAJ'),
('Gina Shaw', 'Dw7fDwAAQBAJ'),
('Giovanni Battista Cotta', 'elNMAAAAcAAJ'),
('Giulia Brusco', 'h3GyEAAAQBAJ'),
('Giuseppe De Marco', '4MfUAgAAQBAJ'),
('Giuseppe F. Italiano', 'b4gxPQAACAAJ'),
('Giuseppe Nardulli', 'fcHjh8jIeGkC'),
('Giuseppe Psaila', 'mSpXfV15GPgC'),
('Hannes Uecker', '3Z87DwAAQBAJ'),
('Hidenori Kusaka', 'gLeSAQAACAAJ'),
('Hidenori Kusaka', 'VlQMMQAACAAJ'),
('Iela Mari', 'Y3NlAgAACAAJ'),
('Irene Finocchi', 'b4gxPQAACAAJ'),
('Ivano Bertini', 'NADCXwAACAAJ'),
('J. E EDITOR MARSDEN', 'KduhuwEACAAJ'),
('James Gosling', 'Vpl86eYrBVMC'),
('Jesús Hervás', 'h3GyEAAAQBAJ'),
('Ken Arnold', 'Vpl86eYrBVMC'),
('Luisa Perotti', '6HaiDwAAQBAJ'),
('Maarten Van Steen', 'uhrblChZ5_wC'),
('Marco Bramanti', 'Bq4hQAAACAAJ'),
('Marco Bramanti', 'ebi3PAAACAAJ'),
('Marlene Clapp', 'LXA5VzAKY98C'),
('Matilde Trevisani', 'PmKkOnn2SyIC'),
('Matteo Salvo', 'jR33FtEh71kC'),
('Matthew K. Manning', '0vKiDwAAQBAJ'),
('Melanie Scott', '0vKiDwAAQBAJ'),
('Michael Eugene Taylor', 'KduhuwEACAAJ'),
('Michael McAvennie', '0vKiDwAAQBAJ'),
('Monica Conti', 'K9g_BAAAQBAJ'),
('Nader Butto', 'BTZJsTU6DLgC'),
('Nancy Conner', 'SZtsFe66zucC'),
('Neil deGrasse Tyson', 'hx5DDQAAQBAJ'),
('Nick Snels', 'i98sEAAAQBAJ'),
('Nicola Torelli', 'PmKkOnn2SyIC'),
('P M Suski', '9DuiAwAAQBAJ'),
('Paola Gervasio', '4VGFoAEACAAJ'),
('Paolo Atzeni', 'gyqFPQAACAAJ'),
('Paolo Corazzon', '-R106Urv198C'),
('Paul Wellens', 'ULRJCgAAQBAJ'),
('Piero Fraternali', 'gyqFPQAACAAJ'),
('Riccardo Sacco', '4VGFoAEACAAJ'),
('Riccardo Torlone', 'gyqFPQAACAAJ'),
('Rita Bressan', '6HaiDwAAQBAJ'),
('Robert Spector', '-3ccLlxnJTQC'),
('Roger K. Leir', 'wZW8zlgdSKQC'),
('Roland Barthes', '2HkTAAAACAAJ'),
('Romano Fantacci', 'nOnvDwAAQBAJ'),
('S. Speroni Zagrljaca', 'ETSNu0mDMRcC'),
('Sal Esmeralda', '4ErGAwAAQBAJ'),
('Sal Esmeralda', 'nOnvDwAAQBAJ'),
('Salvatore Conte', 'r2P8DwAAQBAJ'),
('Sandro Salsa', 'Bq4hQAAACAAJ'),
('Sandro Salsa', 'ebi3PAAACAAJ'),
('Sandro Salsa', 'MbcnAAAACAAJ'),
('Sara Pichelli', 'H-v2DwAAQBAJ'),
('Satoshi Yamamoto', 'VlQMMQAACAAJ'),
('Saverio Rubini', 'aGPpKiMfcxsC'),
('Scholastic', 'y9ibDwAAQBAJ'),
('Silvia Fernández', 'VhfYywEACAAJ'),
('Simone Venturini', 'o0wAEAAAQBAJ'),
('Simone Venturini', 'W5Cy5ozqh34C'),
('Stefano Bertocchi', '-R106Urv198C'),
('Stefano Ceri', 'gyqFPQAACAAJ'),
('Stefano Paraboschi', 'gyqFPQAACAAJ'),
('Stephen Gasiorowicz', 'NXMtCwAAQBAJ'),
('Stephen King', '8VnJLu3AvvQC'),
('Stephen King', 'S6TOxwEACAAJ'),
('Stephen W. Hawking', 'lEt_1qjW4vAC'),
('Stig Bakken', '3RQOMzB5DboC'),
('Tommaso Ariemma', 'BoDXzwEACAAJ'),
('Tullio Facchinetti', 'K-9ZrgEACAAJ'),
('Vincenzo Cinanni', 'FsTIAAAACAAJ'),
('Virgilio Malvezzi', 'CNk_BAAAQBAJ'),
('Vittorio Moriggia', 'mSpXfV15GPgC'),
('Vivina Laura Barutello', 'K9g_BAAAQBAJ'),
('Who HQ', 'Dw7fDwAAQBAJ'),
('William Gibson', 'CpasBAAAQBAJ'),
('William Shakespeare', 'yCeGJKSIZkYC');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--
-- Creazione: Ott 08, 2023 alle 21:22
-- Ultimo aggiornamento: Ott 16, 2023 alle 11:06
--

DROP TABLE IF EXISTS `utente`;
CREATE TABLE `utente` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `stato` tinyint(1) DEFAULT 0,
  `avatar` varchar(256) DEFAULT '/bookexchange/imgs/useravatars/default-avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELAZIONI PER TABELLA `utente`:
--

--
-- Dump dei dati per la tabella `utente`
--

INSERT IGNORE INTO `utente` (`id`, `username`, `email`, `password`, `stato`, `avatar`) VALUES
(23, 'Pasquale Cioffi', 'pasquale.cioffi1@studenti.unicampania.it', '$2y$10$4FoMA7p3vbcsFHnAaLJsf.I714UD/LqGmBdFd8n9dnxvxJDip2qf6', 1, '/bookexchange/imgs/useravatars/pasquale.cioffi1@studenti.unicampania.itavatar.jpg'),
(29, 'Cioffi Pasquale', 'cioffipasquale@gmail.com', '$2y$10$gvd9UzOl9eeEc7/UDYgltuHK2bNsFjwaPfXcsHgKnj/szRZz5WyDW', 0, '/bookexchange/imgs/useravatars/default-avatar.png'),
(30, 'Pikachu', 'pikachu@gmail.com', '$2y$10$ax4qG8uN1V4hk2GCYC70Z.Q482VZPFhOvJv1u.oz1QvjSh2pCJr56', 0, '/bookexchange/imgs/useravatars/pikachu@gmail.comavatar.png'),
(31, 'Pepe', 'pepe@gmail.com', '$2y$10$YwKUD/0z6g/WFvey6FOskOkMnbndslpviW8lS0LeRT.pT6FW9wD5a', 0, '/bookexchange/imgs/useravatars/pepe@gmail.comavatar.gif'),
(32, 'BBALE', 'pascucreaserver@nabbo.lol', '$2y$10$Oghnk4TXjWZgV8J.GV.3pOQXuZSy3jkyUE8TVULvsZ.T8gxLuOSK6', 0, '/bookexchange/imgs/useravatars/default-avatar.png'),
(33, 'Test', 'test@gmail.com', '$2y$10$Y0v4jduVCQPZYgQKBrM.CeVryVDCdXTe.oq8q0jWH1KPWQtmBCTMq', 0, '/bookexchange/imgs/useravatars/test@gmail.comavatar.gif');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `autore`
--
ALTER TABLE `autore`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria`,`libro`),
  ADD KEY `libro` (`libro`);

--
-- Indici per le tabelle `conversazione`
--
ALTER TABLE `conversazione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente1` (`utente1`),
  ADD KEY `utente2` (`utente2`);

--
-- Indici per le tabelle `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `messaggio`
--
ALTER TABLE `messaggio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversazione` (`conversazione`),
  ADD KEY `mittente` (`mittente`),
  ADD KEY `destinatario` (`destinatario`);

--
-- Indici per le tabelle `possesso`
--
ALTER TABLE `possesso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proprietario` (`proprietario`),
  ADD KEY `libro` (`libro`);

--
-- Indici per le tabelle `scambio`
--
ALTER TABLE `scambio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scambio_ibfk_6` (`proposta`),
  ADD KEY `scambio_ibfk_7` (`offerta`);

--
-- Indici per le tabelle `scrittura`
--
ALTER TABLE `scrittura`
  ADD PRIMARY KEY (`autore`,`libro`),
  ADD KEY `autore` (`autore`),
  ADD KEY `libro` (`libro`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `conversazione`
--
ALTER TABLE `conversazione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT per la tabella `possesso`
--
ALTER TABLE `possesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT per la tabella `scambio`
--
ALTER TABLE `scambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `categoria`
--
ALTER TABLE `categoria`
  ADD CONSTRAINT `categoria_ibfk_1` FOREIGN KEY (`libro`) REFERENCES `libro` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `conversazione`
--
ALTER TABLE `conversazione`
  ADD CONSTRAINT `conversazione_ibfk_1` FOREIGN KEY (`utente1`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `conversazione_ibfk_2` FOREIGN KEY (`utente2`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `messaggio`
--
ALTER TABLE `messaggio`
  ADD CONSTRAINT `messaggio_ibfk_1` FOREIGN KEY (`conversazione`) REFERENCES `conversazione` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messaggio_ibfk_2` FOREIGN KEY (`mittente`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `messaggio_ibfk_3` FOREIGN KEY (`destinatario`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `possesso`
--
ALTER TABLE `possesso`
  ADD CONSTRAINT `possesso_ibfk_1` FOREIGN KEY (`proprietario`) REFERENCES `utente` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `possesso_ibfk_2` FOREIGN KEY (`libro`) REFERENCES `libro` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `scambio`
--
ALTER TABLE `scambio`
  ADD CONSTRAINT `scambio_ibfk_6` FOREIGN KEY (`proposta`) REFERENCES `possesso` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `scambio_ibfk_7` FOREIGN KEY (`offerta`) REFERENCES `possesso` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limiti per la tabella `scrittura`
--
ALTER TABLE `scrittura`
  ADD CONSTRAINT `scrittura_ibfk_1` FOREIGN KEY (`autore`) REFERENCES `autore` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `scrittura_ibfk_2` FOREIGN KEY (`libro`) REFERENCES `libro` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
