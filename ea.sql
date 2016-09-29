-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2016 at 10:56 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE ea;
USE ea;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ea`
--

-- --------------------------------------------------------

--
-- Table structure for table `alfa`
--

CREATE TABLE `alfa` (
  `a` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `centro`
--

CREATE TABLE `centro` (
  `idcentro` int(3) NOT NULL,
  `nome` varchar(60) COLLATE utf8_bin NOT NULL,
  `telefono` varchar(10) COLLATE utf8_bin NOT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `interno` varchar(2) COLLATE utf8_bin NOT NULL,
  `coordinate` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `centro`
--

INSERT INTO `centro` (`idcentro`, `nome`, `telefono`, `email`, `interno`, `coordinate`) VALUES
(1, 'Eastern Analogic', '0712201', 'info@easternanalogic.com', 'si', '43.586533,  13.517393'),
(2, 'Eastern Analogic Napoli', '081102030', 'napoli.assistenza@easternanalogic.com', 'si', '40.851261, 14.267370'),
(3, 'Eastern Analogic Roma', '06102030', 'roma.assistenza@easternanalogic.com', 'si', '41.895250, 12.479739'),
(4, 'Eastern Analogic Milano', '02102030', 'milano.assistenza@easternanalogic.com', 'si', '45.472917, 9.153697'),
(5, 'Eastern Analogic Torino', '011102030', 'torino.assistenza@easternanalogic.com', 'si', '45.075682, 7.677624'),
(6, 'Apulia Server', '080102030', 'assistenza@apuliaserver.it', 'no', '41.118637, 16.868778'),
(7, 'Triple S.R.L', '070102030', 'assistenza@triplesrl.it', 'no', '39.233278, 9.112442'),
(8, 'Help PC', '0971102030', 'potenza.assistenza@easternanalogic.com', 'no', '40.649815, 15.795119'),
(9, 'Server Professional', '051102030', 'bologna.assistenza@easternanalogic.com', 'si', '44.504949, 11.331791');

-- --------------------------------------------------------

--
-- Table structure for table `componente`
--

CREATE TABLE `componente` (
  `idcomponente` int(3) NOT NULL,
  `marca` varchar(50) COLLATE utf8_bin NOT NULL,
  `modello` varchar(50) COLLATE utf8_bin NOT NULL,
  `foto` varchar(100) COLLATE utf8_bin NOT NULL,
  `descrizione` varchar(400) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `componente`
--

INSERT INTO `componente` (`idcomponente`, `marca`, `modello`, `foto`, `descrizione`) VALUES
(1, 'AMD', 'Opteron 2384', 'amd-opteron.jpg', 'Progettata per crescere in base alle tue esigenze. <br>\r\nDettagli: <br>\r\n- Socket: SD2650JAHMBOX<br>\r\n- Frequenza:	1.40 Ghz<br>\r\n- Architettura: Kabini<br>\r\n- Dual Core	2 core<br>\r\n- Cache L2	1 MB <br>\r\n- Supporto Grafica HD 8240 <br>\r\nValori di lavoro <br>\r\n- Consumo	25W <br>'),
(2, 'Intel', 'Xeon E5550', 'xeon.jpg', '<br>Intel presenta il nuovo processore Core Xeon E55. Quad Core con processo produttivo a 22 micron. <br> Dedicato a mainboard con socket LGA 1155. Frequenza di clock a 3,4 GHz (3,9 GHz in modalità Turbo) e 8 MB di cache L3. Fornito con dissipatore e ventola.<br>\r\nNumero del processore<br>\r\ni7-3770T<br>\r\nNumero di core<br>\r\n4<br>\r\nNumero di thread<br>\r\n8<br>\r\nVelocità di clock<br>\r\n2.5 GHz'),
(3, 'Samsung', 'DP-HDD', 'hd.jpg', 'Le unità disco rigido SATA ottimizzano le prestazioni dei Server Eastern Analogic offrendo tecnologie in grado di soddisfare esigenze sempre maggiori di archiviazione dei dati.<br> \r\nSpecifiche tecniche	<br>\r\nCapacità	1.000 GB <br>Interfaccia	SATA<br>\r\nVelocità di trasmissione<br>600 Mbit/s <br>	Velocità di rotazione	7.200 rpm<br>\r\nAverage latency	8,5 ms<br>Buffer	32 Mb<br>\r\nFull stroke seek	25 ms'),
(4, 'FUJITSU', 'Hard-Fire', 'fujitsu.jpg', '<br><br>Specifiche tecniche	<br><br>\r\nCapacità	600 GB<br>	Interfaccia SAS<br>\r\nVelocità di trasmissione	6.000 Mbit/s<br>	Velocità di rotazione	15.000 rpm<br>\r\nAverage latency	2 ms <br>	Buffer	16 Mb<br>\r\nFull stroke seek	8 ms'),
(5, 'CRUCIAL', 'Atom Ram', 'crucial.jpg', 'Memory <br>\r\nType	DRAM <br>\r\nTechnology	DDR4 SDRAM<br>\r\nForm Factor	DIMM 288-pin<br>\r\nSpeed	2133 MHz ( PC4-17000 )<br>\r\nLatency Timings	CL15<br>\r\nData Integrity Check	Non-ECC<br>\r\nFeatures	Single rank , unbuffered<br>\r\nChips Organization	512 x 8<br>\r\nVoltage	1.2 V'),
(6, 'Corsair', 'Value Select', 'corsair.jpg', 'Specifiche tecniche:\r\n\r\nDensità: 4GB (1x4GB) <br>\r\nVelocità: 2133MHz<br>\r\nLatenza testata: 15-15-15-36<br>\r\nTensione: 1.2V<br>\r\nFormato: DIMM<br>\r\nPin Out: 288 Pin<br>'),
(7, 'Intel', 'i7-5820K', 'i7.jpg', '6 Core I7-5820K Socket LGA2011-v3 3.3GHz <br>\r\nTurbo Boost Technology 2.0 <br>\r\nSupported memory: DDR4-2133 <br>\r\n28 PCI 3.0 Lanes <br>\r\n15 MB Intel smart cache <br>\r\nCore I7-5820K Socket LGA2011-v3 <br>\r\nTurbo Boost Technology 2.0 <br>'),
(8, 'AMD', 'FX-8320', 'amd64-4000.jpg', 'Frequency: 3.5/4.0GHZ (Base/Overdrive) <br>\r\nCores: 8 <br>\r\nCache: 8/8MB (L2/L3) <br>\r\nSocket Type: AM3+ <br>\r\nPower Wattage: 125W <br>'),
(9, 'Crucial', 'Ballistix Tactical', 'Crucial-Ballistix-Tactical.jpg', 'Designed for performance enthusiasts, gamers and power users <br>\r\nEnhanced heat spreader<br>\r\nLow Profile and Low Voltage <br>\r\nIndustry Standard specifications <br>\r\nAdvanced Speeds and timings (XMP Profile) <br>\r\nA Micron CPG Product <br>'),
(10, 'G.Skill', 'RipjawsX', 'RipjawsX.jpg', '128GB DDR3 PC3-17000 Dual channel kit 2x4GB <br>\r\n2133MHz CL9 (9-11-10-28) <br>\r\nFor Intel Z68/P67 platforms <br>\r\n240 pins <br>\r\n1.65V <br>'),
(11, 'MSI Computer Corp.e', 'H81M-E34', 'amd-FX-8320.jpg', 'CPU: LGA1150 <br>\r\nSupports 4th Generation Intel Core i7/ i5/ i3/ Pentium/ Celeron Processors <br>\r\nChipset: Intel H81 Express <br>\r\nMemory: 2x DDR3-1600/ 1333/ 1066 DIMM Slots, Dual Channel, Non-ECC, Buffered, Max Capacity of 16GB <br>\r\nSlots: 1x PCI-Express 2.0 x16 Slot, 2x PCI-Express 2.0 x1 Slots <br>\r\nSATA: 2x SATA3 Ports, 2x SATA2 Ports <br>\r\nAudio: Realtek ALC887 Audio CODEC'),
(12, 'ASRock', 'Super Alloy H97M-ITX', 'amd-FX-8320.jpg', 'Memory: 2x DDR3-1600/ 1333/ 1066 DIMM Slots, Dual Channel, Non-ECC, Unbuffered, Max Capacity of 16GB <br>\r\nSlots: 1x PCI-Express 3.0 x16 Slot, 1x Mini-PCI Express Slot (Vertical Half, for WiFi + BT Module) <br>\r\nSATA: 5x SATA3 Ports, Support RAID 0, 1, 5, 10 <br>'),
(13, 'ccc', 'Aaa', 'fujitsu.jpg', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `elencocomponenti`
--

CREATE TABLE `elencocomponenti` (
  `idelencocomponenti` int(3) NOT NULL,
  `idprodotto` int(3) NOT NULL,
  `idcomponente` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `elencocomponenti`
--

INSERT INTO `elencocomponenti` (`idelencocomponenti`, `idprodotto`, `idcomponente`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 5),
(4, 2, 2),
(5, 2, 4),
(6, 2, 6),
(7, 1, 11),
(8, 2, 12),
(9, 3, 7),
(10, 3, 10),
(11, 3, 12),
(12, 3, 4),
(13, 4, 2),
(14, 4, 12),
(15, 4, 9),
(16, 4, 4),
(17, 6, 12),
(18, 6, 2),
(19, 6, 9),
(20, 6, 4),
(21, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `elencoproblemi`
--

CREATE TABLE `elencoproblemi` (
  `idelencoproblemi` int(3) NOT NULL,
  `idprodotto` int(3) NOT NULL,
  `idproblema` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `elencoproblemi`
--

INSERT INTO `elencoproblemi` (`idelencoproblemi`, `idprodotto`, `idproblema`) VALUES
(1, 1, 2),
(2, 1, 5),
(3, 1, 8),
(4, 2, 4),
(5, 2, 5),
(6, 3, 7),
(7, 3, 5),
(8, 4, 2),
(9, 4, 9),
(10, 4, 4),
(11, 4, 3),
(12, 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `idfaq` int(3) NOT NULL,
  `domanda` varchar(150) COLLATE utf8_bin NOT NULL,
  `risposta` varchar(400) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`idfaq`, `domanda`, `risposta`) VALUES
(1, 'Siamo studenti intenzionati ad acquistare un Server. Esistono sconti dedicati agli universitari?', 'Attualmente la nostra offerta si rivolge solo ad aziende e non abbiamo offerte rivolte esclusivamente agli studenti.'),
(2, 'Qual è la differenza tra centri assistenza Eastern Analogic e centri assistenza autorizzati?', 'I centri assistenza Eastern Analogic sono i centri assistenza ufficiali dell''''azienda. I centri autorizzati sono invece dei centri esterni, indipendenti da Eastern Analogic, che hanno ottenuto l''''autorizzazione a fornire assistenza per i nostri prodotti.'),
(3, 'Quale standard di cifratura utilizza Eastern Analogic?', 'Eastern Analogic utilizza i più avanzati standard di cifratura: oltre a garantire una cifratura AES a 256 bit, l''algoritmo proprietario utilizzato da Eastern Analogic utilizza un sistema che assegna una chiave random a 2048 bit ad ogni singolo file, rendendolo un sistema di sicurezza paragonabile a quelli di livello militare.'),
(4, 'Dove vengono conservate le chiavi di cifratura?', 'Per non mettere mai a rischio la riservatezza delle informazioni contenute nelle risorse cifrate, Eastern Analogic conserva le chiavi di cifratura e decifratura centralmente invece che sul dispositivo utilizzato per l’accesso al file stesso: in questo modo si ha la certezza che il file non possa in alcun modo essere decifrato in assenza dell’autorizzazione verificata da Eastern Analogic.'),
(5, 'Che sistema operativo viene utilizzato sui vostri server?', 'Eastern Analogic utilizza principalmente un sistema operativo proprietario basato su GNU/Linux. Tuttavia, in fase di acquisto è possibile scegliere sistemi come: Fedora, Debian e Arch. In ogni caso, viene installata l''applicazione Easy Setup, che consente di installare tutte le utility di sistema messe a disposizione da Eastern Analogic.'),
(6, 'Quale gestore dei pacchetti utilizzano i vostri prodotti?', 'Di default, i nostri prodotti utilizzano il gestore dei pacchetti EAP (Eastern Analogic Packaging). È possibile utilizzarlo sia da interfaccia grafica (mediante l''applicazione EA Store), sia attraverso la riga di comando (digitando "eap -h" per la guida all''uso).<br>\r\nSu richiesta del cliente, possono essere installati gestori dei pacchetti differenti (apt-get e yum).'),
(12, 'come mi chiamo?', 'mi chiamo andrea'),
(13, 'Che ore sono adesso?', 'Le 9.40');

-- --------------------------------------------------------

--
-- Table structure for table `problema`
--

CREATE TABLE `problema` (
  `idproblema` int(3) NOT NULL,
  `problema` varchar(50) COLLATE utf8_bin NOT NULL,
  `soluzione` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `problema`
--

INSERT INTO `problema` (`idproblema`, `problema`, `soluzione`) VALUES
(1, 'Il prodotto non si avvia.', 'Testare il funzionamento dei cavi di alimentazione e dell''alimentatore. \r\n<br> Nel caso in cui il problema non sia dovuto all''alimentatore, testare il funzionamento della scheda madre.'),
(2, 'Schermo nero e 3 bip all''accensione', 'Il danno è dovuto alla rottura dell''hard disk. <br> Sostituire l''hard disk con un modello compatibile.'),
(3, 'Il server si spegne improvvisamente', 'Il problema potrebbe essere causato da:<br>\r\nPasta termica consumata;<br>\r\nCpu danneggiata <br>\r\nSistema di raffreddamento non funzionante.<br>\r\nTestare il sistema di raffreddamento e controllare che la quantità di pasta termica sia corretta.'),
(4, 'Schermo nero e 2 bip all''accensione', 'La memoria Ram non è funzionante. <br>\r\nÈ necessaria la sostituzione con un modello compatibile'),
(5, 'Supporto GIT/SVN non funzionante.', 'Avviare il "System App Checker" digitando da console: "sudo syscheck". \r\n<br> Il programma permetterà la reinstallazione dei programmi di sistema, incluso il supporto a GIT/SVN.'),
(6, 'Interprete PHP non funzionante', 'Avviare il "System App Checker" digitando da console: "sudo syscheck". \r\n<br> Il programma permetterà la reinstallazione dei programmi di sistema, incluso l''interprete PHP'),
(7, 'Il sistema operativo non si avvia.', 'Durante l''accensione premere il pulsante "Reset". <br>\r\nVerrà avviato un tool che permetterà la scelta della copia di backup più recente per il ripristino o, in caso in cui non ci siano backup, il ripristino del sistema.'),
(8, 'Le copie di backup non vengono eseguite', 'Lanciare il comando "check backup options" per controllare le opzioni di backup. <br>\r\nPer resettare le impostazioni, digitare il comando "reset backup options".'),
(9, 'Impossibile installare la Java Virtual Machine', 'Avviare il "System App Checker" digitando da console: "sudo syscheck". \r\nIl programma permetterà la reinstallazione dei programmi di sistema, inclusa la JVM');

-- --------------------------------------------------------

--
-- Table structure for table `prodotto`
--

CREATE TABLE `prodotto` (
  `idprodotto` int(3) NOT NULL,
  `modello` varchar(50) COLLATE utf8_bin NOT NULL,
  `foto` varchar(100) COLLATE utf8_bin NOT NULL,
  `descrizione` text COLLATE utf8_bin NOT NULL,
  `installazione` text COLLATE utf8_bin NOT NULL,
  `uso` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prodotto`
--

INSERT INTO `prodotto` (`idprodotto`, `modello`, `foto`, `descrizione`, `installazione`, `uso`) VALUES
(1, 'cloudline e1', 'server1.png', 'Il server Cloudline E1 è il prodotto entry-level di Eastern Analogic.<br>\r\nÈ particolarmente indicato per svolgere mansioni che non richiedono elevate risorse hardware, quali l''hosting di piccole e medie app in php.', 'Il prodotto comprende il tool "Easy Setup" che consente di personalizzare tutte le opzioni del setup in maniera facile.\r\nLe opzioni consigliate sono: <br>\r\nAbilitare il backup automatico (il prodotto esegue 2 backup al giorno). <br>\r\nAbilitare la partizione dati, in modo tale da separare il sistema operativo dai dati che utilizza.', 'Eastern Analogic consiglia di evitare l''utilizzo di grandi applicazioni web, e di mantenere gli aggiornamenti automatici attivi.<br>\r\nSi consiglia inoltre di non disabilitare il servizio di protezione, che consente di essere protetti da attacchi DoS.'),
(2, 'zeus z4', 'server4.png', 'Zeus Z4 è il prodotto di fascia alta della Eastern Analogic.<br> \r\nQuesto prodotto ha i migliori componenti ed è in grado di reggere pesanti applicazioni Web.<br>\r\nLe caratteristiche eccelse dell''hardware lo rendono il miglior prodotto della Eastern Analogic e uno dei migliori server al mondo.', 'Il prodotto comprende il tool "Easy Setup" che consente di personalizzare tutte le opzioni del setup in maniera facile.\r\nLe opzioni consigliate sono: <br>\r\nAbilitare il backup automatico (il prodotto esegue 3 backup al giorno). <br>\r\nAbilitare la partizione dati, in modo tale da separare il sistema operativo dai dati che utilizza.', 'Eastern Analogic consiglia di evitare l''utilizzo di grandi applicazioni web, e di mantenere gli aggiornamenti automatici attivi.<br>\r\nSi consiglia inoltre di non disabilitare il servizio di protezione, che consente di essere protetti da attacchi DoS & DDos.'),
(3, 'proliant dl380p', 'Proliant DL380p.jpg', 'Proliant DL380p è il prodotto di fascia alta della Eastern Analogic.\r\nQuesto prodotto ha ottimi componenti ed è in grado di reggere pesanti applicazioni Web.\r\nLe caratteristiche eccelse dell''hardware lo rendono uno tra i migliori prodotti della Eastern Analogic e uno dei migliori server al mondo.', 'Il prodotto comprende il tool "Easy Setup" che consente di personalizzare tutte le opzioni del setup in maniera facile. Le opzioni consigliate sono: \r\nAbilitare il backup automatico (il prodotto esegue 4 backup al giorno).\r\nAbilitare la partizione dati, in modo tale da separare il sistema operativo dai dati che utilizza.', 'Eastern Analogic consiglia di evitare l''utilizzo di grandi applicazioni web, e di mantenere gli aggiornamenti automatici attivi.\r\nSi consiglia inoltre di non disabilitare il servizio di protezione, che consente di essere protetti da attacchi DoS & DDos.'),
(4, 'proliant ml115', 'ProLiant ML115.jpg', '<br>Proliant ML115 è il prodotto di fascia media della Eastern Analogic.\r\nLe discrete caratteristiche hardware di questo prodotto, lo rendono particolarmente adatto a supportare medie e grandi applicazioni Web.', 'Il prodotto comprende il tool "Easy Setup" che consente di personalizzare tutte le opzioni del setup in maniera facile. Le opzioni consigliate sono: \r\nAbilitare il backup automatico (il prodotto esegue 3 backup al giorno).\r\nAbilitare la partizione dati, in modo tale da separare il sistema operativo dai dati che utilizza.', 'Eastern Analogic consiglia di evitare l''utilizzo di grandi applicazioni web, e di mantenere gli aggiornamenti automatici attivi.\r\nSi consiglia inoltre di non disabilitare il servizio di protezione, che consente di essere protetti da attacchi DoS & DDos.'),
(5, 'poweredge t620', 'PowerEdge T620.jpg', 'Il server PowerEdge T620 è il prodotto di fascia media di Eastern Analogic. È particolarmente indicato per svolgere mansioni che non richiedono elevate risorse hardware, quali l''hosting di piccole e medie app in php.', 'Il prodotto comprende il tool "Easy Setup" che consente di personalizzare tutte le opzioni del setup in maniera facile. Le opzioni consigliate sono: Abilitare il backup automatico (il prodotto esegue 2 backup al giorno). Abilitare la partizione dati, in modo tale da separare il sistema operativo dai dati che utilizza.', 'Eastern Analogic consiglia di evitare l''utilizzo di grandi applicazioni web, e di mantenere gli aggiornamenti automatici attivi. Si consiglia inoltre di non disabilitare il servizio di protezione, che consente di essere protetti da attacchi DoS'),
(6, 'system x3500', 'System-x3500.jpg', '<br><br><br>Il server System x3500 è il miglior server prodotto da Eastern Analogic.\r\nGrazie alle sue eccellenti caratteristiche, è in grado di supportare grandi carichi di lavoro, applicazioni Web molto pesanti e complessi calcoli matematici.\r\nGrazie al potente processore, al doppio hard drive e ad una capiente memoria ram, il System x3500 riesce ad eseguire un backup ogni ora, senza rallentare o danneggiare l''esperienza d''uso degli utenti.\r\nInoltre, il firewall personalizzato e la suite "EA Total Security" garantiscono una protezione continua, efficace ed efficente.', 'Il prodotto comprende il tool "Easy Setup" che consente di personalizzare tutte le opzioni del setup in maniera facile.\r\nLe opzioni consigliate sono:\r\n<br>1) Abilitare il backup automatico (il prodotto esegue 1 backup all''ora).\r\n<br>2) Abilitare "EA Total Security"\r\n<br>3)Abilitare la partizione dati, in modo tale da separare il sistema operativo dai dati che utilizza.', 'Eastern Analogic consiglia di mantenere gli aggiornamenti automatici attivi. \r\nSi consiglia inoltre di non disabilitare il servizio di protezione, che consente di essere protetti da attacchi DoS, DDos e Sql-Injection.'),
(7, 'processore md', 'amd64-4000.jpg', 'AAAAA', 'AAAA', 'AAAAA');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `idutente` int(3) NOT NULL,
  `nome` varchar(30) COLLATE utf8_bin NOT NULL,
  `cognome` varchar(30) COLLATE utf8_bin NOT NULL,
  `email` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `ruolo` varchar(30) COLLATE utf8_bin NOT NULL,
  `idcentro` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`idutente`, `nome`, `cognome`, `email`, `password`, `ruolo`, `idcentro`) VALUES
(1, 'Richard', 'Stallman', 'admin', 'dd20f26484a76dc993a9872468dd17af', 'admin', 1),
(2, 'Bill', 'Gates', 'staff', 'dd20f26484a76dc993a9872468dd17af', 'staff', 1),
(3, 'Agostino', 'Lorenzi', 'a.lorenzi@easternanalogic@com', 'dd20f26484a76dc993a9872468dd17af', 'staff', 1),
(4, 'Tim', 'Cook', 'tec', 'dd20f26484a76dc993a9872468dd17af', 'tecnico', 2),
(5, 'Martin', 'McFly', 'mcfly@gmail.com', 'dd20f26484a76dc993a9872468dd17af', 'tecnico', 4),
(6, 'Jacob', 'Nielsen', 'j.nielsen@gmail.com', 'dd20f26484a76dc993a9872468dd17af', 'tecnico', 9),
(7, 'Enrico', 'Rossi', 'rossi_enrico@gmail.com', 'dd20f26484a76dc993a9872468dd17af', 'tecnico', 6),
(8, 'Mario', 'Bianchi', 'bianchi-mario@triplesrl.it', 'dd20f26484a76dc993a9872468dd17af', 'tecnico', 7),
(9, 'Steve', 'Jobs', 'steve@jobs.it', 'dd20f26484a76dc993a9872468dd17af', 'tecnico', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centro`
--
ALTER TABLE `centro`
  ADD PRIMARY KEY (`idcentro`);

--
-- Indexes for table `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`idcomponente`);

--
-- Indexes for table `elencocomponenti`
--
ALTER TABLE `elencocomponenti`
  ADD PRIMARY KEY (`idelencocomponenti`),
  ADD KEY `esistenzapc` (`idprodotto`),
  ADD KEY `esistenzacp` (`idcomponente`);

--
-- Indexes for table `elencoproblemi`
--
ALTER TABLE `elencoproblemi`
  ADD PRIMARY KEY (`idelencoproblemi`),
  ADD KEY `esistenzaprod` (`idprodotto`),
  ADD KEY `esistenzaproblema` (`idproblema`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`idfaq`);

--
-- Indexes for table `problema`
--
ALTER TABLE `problema`
  ADD PRIMARY KEY (`idproblema`);

--
-- Indexes for table `prodotto`
--
ALTER TABLE `prodotto`
  ADD PRIMARY KEY (`idprodotto`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idutente`),
  ADD KEY `idcentro` (`idcentro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centro`
--
ALTER TABLE `centro`
  MODIFY `idcentro` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `componente`
--
ALTER TABLE `componente`
  MODIFY `idcomponente` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `elencocomponenti`
--
ALTER TABLE `elencocomponenti`
  MODIFY `idelencocomponenti` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `elencoproblemi`
--
ALTER TABLE `elencoproblemi`
  MODIFY `idelencoproblemi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `idfaq` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `problema`
--
ALTER TABLE `problema`
  MODIFY `idproblema` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `prodotto`
--
ALTER TABLE `prodotto`
  MODIFY `idprodotto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `idutente` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `elencocomponenti`
--
ALTER TABLE `elencocomponenti`
  ADD CONSTRAINT `elencocomponenti_ibfk_1` FOREIGN KEY (`idprodotto`) REFERENCES `prodotto` (`idprodotto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elencocomponenti_ibfk_2` FOREIGN KEY (`idcomponente`) REFERENCES `componente` (`idcomponente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `elencoproblemi`
--
ALTER TABLE `elencoproblemi`
  ADD CONSTRAINT `elencoproblemi_ibfk_1` FOREIGN KEY (`idprodotto`) REFERENCES `prodotto` (`idprodotto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `elencoproblemi_ibfk_2` FOREIGN KEY (`idproblema`) REFERENCES `problema` (`idproblema`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
