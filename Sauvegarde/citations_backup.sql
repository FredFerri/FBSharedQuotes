-- MySQL dump 10.13  Distrib 5.5.52, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: citations
-- ------------------------------------------------------
-- Server version	5.5.52-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) NOT NULL,
  `biography` text,
  `country` varchar(40) DEFAULT NULL,
  `birthdate` varchar(10) DEFAULT NULL,
  `deathdate` varchar(10) DEFAULT NULL,
  `category_txt` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (57,'Albert','Einstein','udezy ieyzrtez truei tuztu ruzuie yirz ','Allemagne','1890','1935','physicien'),(58,'friedrichz','nietzschez','udezy ieyzrtez truei tuztu ruzuie yirz ','Allemagne','1890','1935','philosophe');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quote`
--

DROP TABLE IF EXISTS `quote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quote` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `content` varchar(550) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `author` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quote`
--

LOCK TABLES `quote` WRITE;
/*!40000 ALTER TABLE `quote` DISABLE KEYS */;
INSERT INTO `quote` VALUES (175,'Une sociÃ©tÃ© qui croit ne pas avoir d\'avenir est peu portÃ©e Ã  s\'intÃ©resser aux besoins de la gÃ©nÃ©ration montante [â€¦] Les parents modernes tentent de faire en sorte que leurs enfants se sentent aimÃ©s et voulus, mais cela ne cache guÃ¨re une froideur sous-jacente, Ã©loignement typique de ceux qui ont peu Ã  transmettre Ã  la gÃ©nÃ©ration suivante et qui ont dÃ©cidÃ©, de toute faÃ§on, de donner prioritÃ© Ã  leur droit de s\'accomplir eux-mÃªmes.','1979','La culture du narcissisme','Christopher Lasch'),(177,'A une Ã©poque moins complexe, la publicitÃ© se contentait d\'attirer l\'attention sur un produit et de vanter ses avantages. Maintenant elle fabrique son propre produit: le consommateur, Ãªtre perpÃ©tuellement insatisfait, agitÃ©, anxieux et blasÃ©. La publicitÃ© sert moins Ã  lancer un produit qu\'Ã  promouvoir la consommation comme style de vie.','1979','La culture du narcissisme','Christopher Lasch'),(178,'La propagande de la marchandise se tourne vers la dÃ©solation spirituelle du monde moderne et propose la consommation comme remÃ¨de.','1979','La culture du narcissisme','Christopher Lasch'),(179,'La propagande de la marchandise promet de pallier tous les malheurs traditionnels, mais elle crÃ©e [â€¦) de nouvelles maniÃ¨res d\'Ãªtre malheureux: l\'insÃ©curitÃ© personnelle, l\'anxiÃ©tÃ© quant Ã  la place de l\'individu dans la socitÃ©, l\'angoisse qu\'ont les parents de ne pas Ãªtre capables de satisfaire les besoins de leurs enfants.','1979','La culture du narcissisme','Christopher Lasch'),(181,'Au XXe siÃ¨cle, l\'Ã©lite seule obÃ©issait aux lois de la mode, et renouvelait ses biens et ses achats uniquement parceque les anciens n\'Ã©taient plus au goÃ»t du jour [â€¦] La production en sÃ©rie d\'objets de luxe Ã  fait descendre les habitudes aristocratiques jusqu\'aux masses.','1979','La culture du narcissisme','Christopher Lasch'),(182,'Il est logique, du point de vue de la crÃ©ation de la demande, que les femmes fument et boivent en public, qu\'elles se dÃ©placent librement, qu\'elles affirment leurs droits au bonheur, plutÃ´t que de vivre pour les autres. L\'industrie de la publicitÃ© encourage ainsi une pseudo-Ã©mancipation de la femme [...] et dÃ©guise sa libertÃ© de consommer en autonomie authentique.','1979','La culture du narcissisme','Christopher Lasch'),(183,'Nous vivons dans un monde de pseudo-Ã©vÃ©nements et de quasi informations, oÃ¹ l\'air est saturÃ© de dÃ©clarations qui ne sont ni vraies ni fausses, mais seulement crÃ©dibles.','1979','La culture du narcissisme','Christopher Lasch'),(184,'L\'amour sans discipline n\'est pas suffisant pour assurer la continuitÃ© entre les gÃ©nÃ©rations dont dÃ©pend toute culture. Au lieu de guider l\'enfant, la gÃ©nÃ©ration qui le pÃ©cÃ©da se dÃ©bat, aujourd\'hui, pour essayer \"de suivre les jeunes\", de \"garder le contact\" et de pÃ©nÃ©trer leur jargon incomprÃ©hensible.','1979','La culture du narcissisme','Christopher Lasch'),(185,'L\'abdication par les parents de leur autoritÃ© favorise, chez les jeunes, l\'Ã©closion des maniÃ¨res d\'Ãªtre que demande une culture hÃ©doniste, permissive et corrompue. Le dÃ©clin de l\'autoritÃ© parentale reflÃ¨te \"le dÃ©clin du surmoi\" dans la sociÃ©tÃ© amÃ©ricaine dans son ensemble.','1979','La culture du narcissisme','Christopher Lasch'),(186,'Loin de considÃ©rer le passÃ© comme un fardeau inutile, je vois en lui un trÃ©sor politique et psychique d\'oÃ¹ nous tirons les richesses (pas nÃ©cessairement sous forme de \"leÃ§ons\") nÃ©cessaires pour faire face au futur. L\'indiffÃ©rence de notre culture envers ce qui nous a prÃ©cÃ©dÃ©s - qui se mue facilement en refus ou hostilitÃ© militante - constitue la preuve la plus flagrante de la faillite de cette culture.','1979','La culture du narcissisme','Christopher Lasch'),(187,'Au lieu d\'en juger par notre propre expÃ©rience, nous laissons les experts dÃ©finir nos besoins Ã  notre place ; aprÃ¨s quoi nous nous Ã©tonnons que ceux-ci semblent incapables de jamais nous assouvir.','1979','La culture du narcissisme','Christopher Lasch'),(188,'Lâ€™atrophie des anciennes traditions dâ€™autonomie a Ã©rodÃ© notre compÃ©tence Ã  conduire les affaires de notre vie quotidienne dans un grand nombre de circonstances, et nous a rendus dÃ©pendants de lâ€™Etat, de la grande entreprise et autres bureaucraties.','1979','La culture du narcissisme','Christopher Lasch'),(189,'Lâ€™histoire de la sociÃ©tÃ© moderne est, dâ€™un certain point de vue, celle de lâ€™affirmation dâ€™un contrÃ´le social sur les activitÃ©s jadis dÃ©volues aux individus et aux familles. Dans la phase initiale de la rÃ©volution industrielle les capitalistes arrachÃ¨rent la production du foyer pour la collectiviser Ã  lâ€™intÃ©rieur de lâ€™usine, sous leur surveillance. Ils Ã©tendirent enfin leur contrÃ´le sur la vie privÃ©e des travailleurs : mÃ©decins, psychiatres, enseignants, psychopÃ©dagogues, agents au service des tribunaux pour mineurs et ','1979','La culture du narcissisme','Christopher Lasch'),(190,' Le dÃ©racinement dÃ©racine tout, sauf le besoin de racines','1981','Culture de masse ou culture populaire ? ','Christopher Lasch'),(191,'L\'homme ou la femme moderne, Ã©clairÃ©, Ã©mancipÃ©, se rÃ©vÃ¨le ainsi, lorsqu\'on y regarde de plus prÃ¨s, n\'Ãªtre qu\'un consommateur beaucoup moins souverain qu\'on ne le croit. Loin d\'assister Ã  la dÃ©mocratisation de la culture, il semble que nous soyons plutÃ´t les tÃ©moins de son assimilation totale aux exigences du marchÃ©.','1981','Culture de masse ou culture populaire ? ','Christopher Lasch'),(192,'Les Ã©crivains et les intellectuels, de leur cÃ´tÃ©, doivent prendre conscience que les mÃ©dias de masse ne donnent accÃ¨s Ã  une plus large audience qu\'en imposant, en mÃªme temps, leurs propres conditions.','1981','Culture de masse ou culture populaire ? ','Christopher Lasch'),(193,'Les mÃªmes phÃ©nomÃ¨nes qui ont entrainÃ©s le relÃ¢chement des liens entre parents et enfants ont Ã©galement portÃ© atteinte aux relations entre hommes et femmes. De fait, la dÃ©tÃ©rioration du mariage entraine d\'emblÃ©e la dÃ©gradation des soins apportÃ©s aux jeunes.','1979','La culture du narcissisme','Christopher Lasch'),(194,'Toutes les femmes partagent les avantages et les inconvÃ©nients de leur ','1979','La culture du narcissisme','Christopher Lasch'),(195,'De toute Ã©vidence, les hommes ont toujours redoutÃ© la mort et ont rÃªvÃ© de vivre Ã©ternellement. MalgrÃ© tout, la peur de mourir s\'intensifie dans notre sociÃ©tÃ©, qui s\'est privÃ© de la religion, et tÃ©moigne de peu d\'intÃ©rÃªt pour sa postÃ©ritÃ©.','1979','La culture du narcissisme','Christopher Lasch'),(196,'La peur du grand Ã¢ge peut provenir d\'une Ã©valuation rationnelle et rÃ©aliste du sort rÃ©servÃ© aux personnes Ã¢gÃ©es dans la sociÃ©tÃ© industrielle avancÃ©e; mais elle est ancrÃ©e, en fait, dans une panique irrationnelle. La preuve la plus Ã©vidente en est donnÃ©e par son apparition si prÃ©coce dans le cours d\'une  Hommes et femmes se mettent Ã  craindre de vieillir avant mÃªme d\'avoir atteint l\'Ã¢ge mÃ»r.','1979','La culture du narcissisme','Christopher Lasch'),(197,'Le capitalisme a maintenant Ã©laborÃ© une nouvelle idÃ©ologie politique, une sorte d\'assistance publique libÃ©rale, qui absout l\'individu de toutes responsabilitÃ© morale et le traite comme une victime des conditions sociales. Dans le mÃªme temps, il a mis en place de nouveaux modes de controle social, qui permettent de traiter le dÃ©viant en malade et de remplacer la punition par la rÃ©habilitation mÃ©dicale.','1979','La culture du narcissisme','Christopher Lasch'),(198,'Quiconque s\'Ã©lÃ¨vera sera abaissÃ©, et quiconque s\'abaissera sera Ã©levÃ©.','','Nouveau Testament','Saint Mathieu'),(199,'De mÃªme, vous qui Ãªtes jeunes, soyez soumis aux anciens. Et tous, dans vos rapports mutuels, revÃªtez-vous d\'humilitÃ©; car Dieu rÃ©siste aux orgueilleux, Mais il fait grÃ¢ce aux humbles.','','Nouveau Testament','Saint Pierre'),(200,'La vie est un pont: traversez-la mais n\'y faites pas votre demeure.','XIVe siÃ¨cle','','Sainte Catherine de Sienne'),(201,'Telle est la nature du citronnier que, lorsque ses branches poussent vers le haut, il reste stÃ©rile ; mais plus ses branches s\'inclinent vers le sol, plus il porte de fruits. Celui qui a quelque intelligence comprendra.','VIIe siÃ¨cle','','Saint Jean Climaque'),(202,'Les thÃ©ories sociales qui avaient tant promis, ont fait la preuve de leur faillite et ne nous ont amenÃ©s quâ€™Ã  une impasse. Toutes les tentatives pour sortir le monde actuel de son triste Ã©tat seront vaines, Ã  moins que, pris de repentir, nous ne rectifions lâ€™orientation de notre conscience pour la tourner Ã  nouveau, vers le CrÃ©ateur de toutes choses.','1985','','Alexandre Soljenitsyne'),(203,'MÃªme la biologie nous enseigne quâ€™un haut degrÃ© de confort nâ€™est pas bon pour lâ€™organisme. Aujourdâ€™hui, le confort de la vie de la sociÃ©tÃ© occidentale commence Ã  Ã´ter son masque pernicieux.','1978','Extrait d\'un discours prononcÃ© Ã  Harvard','Alexandre Soljenitsyne'),(204,'Sans quâ€™il y ait besoin de censure, les courants de pensÃ©e, dâ€™idÃ©es Ã  la mode sont sÃ©parÃ©s avec soin de ceux qui ne le sont pas, et ces derniers, sans Ãªtre Ã  proprement parler interdits, nâ€™ont que peu de chances de percer au milieu des autres ouvrages et pÃ©riodiques, ou dâ€™Ãªtre relayÃ©s dans le supÃ©rieur. Vos Ã©tudiants sont libres au sens lÃ©gal du terme, mais ils sont prisonniers des idoles portÃ©es aux nues par lâ€™engouement Ã  la mode.','1978','Extrait d\'un discours prononcÃ© Ã  Harvard','Alexandre Soljenitsyne'),(205,'Si le monde ne touche pas Ã  sa fin, il a atteint une Ã©tape dÃ©cisive dans son histoire [â€¦] Cela va requÃ©rir de nous un embrasement spirituel. Il nous faudra nous hisser Ã  une nouvelle hauteur de vue, Ã  une nouvelle conception de la vie, oÃ¹ notre nature physique ne sera pas maudite, comme elle a pu lâ€™Ãªtre au Moyen Ã‚ge, mais, ce qui est bien plus important, oÃ¹ notre Ãªtre spirituel ne sera pas non plus piÃ©tinÃ©, comme il le fut Ã  lâ€™Ã¨re moderne.','1978','Extrait d\'un discours prononcÃ© Ã  Harvard','Alexandre Soljenitsyne'),(206,'Il est impÃ©ratif que nous revoyions Ã  la hausse lâ€™Ã©chelle de nos valeurs humaines. Sa pauvretÃ© actuelle est effarante. Ce nâ€™est que par un mouvement volontaire de modÃ©ration de nos passions, sereine et acceptÃ©e par nous, que lâ€™humanitÃ© peut sâ€™Ã©lever au-dessus du courant de matÃ©rialisme qui emprisonne le monde.','1978','Extrait d\'un discours prononcÃ© Ã  Harvard','Alexandre Soljenitsyne'),(207,'Quand Dieu efface, câ€™est quâ€™Il va Ã©crire quelque chose.','XVIIe siÃ¨cle','','Bossuet'),(208,'Sâ€™il existait seulement quelque part des gens mauvais, commettant leurs mÃ©faits dans lâ€™ombre, et sâ€™il suffisait seulement de les sÃ©parer du reste de la sociÃ©tÃ© et de les dÃ©truire ! Mais la frontiÃ¨re qui sÃ©pare le bien du mal passe au cÅ“ur de chaque Ãªtre humain et qui est prÃªt Ã  dÃ©truire une partie de son cÅ“ur ?','','','Alexandre Soljenitsyne'),(209,'Ce sont les plus bas instincts qui stimulent les hommes du Kali Yuga (Ã¢ge sombre, Ã¢ge de fer) [â€¦] Les diffÃ©rentes rÃ©gions des pays sâ€™opposent les unes aux autres. Les livres sacrÃ©s ne sont plus respectÃ©s [â€¦] . On tuera les fÅ“tus dans le ventre de leur mÃ¨re et on assassinera les hÃ©ros. [...] Des voleurs deviendront des rois, les rois seront des voleurs. Nombreuses seront les femmes qui auront des rapports avec plusieurs hommes [...] Le dieu des nuages sera incohÃ©rent dans la distribution des pluies [...] Des hommes vils qui auron','13e siÃ¨cle avant JC','Linga-PurÃ¢na','Texte Hindou'),(210,'Il y a un cycle mystÃ©rieux dans les Ã©vÃ©nements humains. A certaines gÃ©nÃ©rations il est beaucoup donnÃ©. A d\' autres, au contraire, il est beaucoup demandÃ©.','1936','Discours Ã  la Convention DÃ©mocrate de Philadelphie','Franklin Delano Roosevelt'),(211,'Rien de ce qui touche Ã  la politique ne relÃ¨ve du hasard ! Soyons sÃ»rs que ce qui se passe en politique a Ã©tÃ© bel et bien programmÃ© !','1936','','Franklin Delano Roosevelt'),(212,'Vous, peuple amÃ©ricain, qui avez officiellement adoptÃ© le christianisme -au point de graver sur votre monnaie \"IN GOD WE TRUST\", vous ne devriez pas mettre votre confiance dans la puissance humaine, ni dans la politique de l\'Ã©conomie car, dans ces deux domaines, il va y avoir du changement','1940','','Edgar Cayce'),(213,'Il faut prÃ©venir les hommes qu\'ils sont en danger de mort... la science devient criminelle.','','','Albert Einstein'),(214,'Peu d\' Ãªtres sont capables d\' exprimer posÃ©ment une opinion diffÃ©rente des prÃ©jugÃ©s de leur milieu. La plupart des Ãªtres sont mÃªme incapables d\' arriver Ã  formuler de telles opinions.','1934','Comment je vois le monde','Albert Einstein'),(215,'Je ne crois point, au sens philosophique du terme, Ã  la libertÃ© de l\' homme. Chacun agit non seulement sous une contrainte extÃ©rieure, mais aussi d\' aprÃ¨s une nÃ©cessitÃ© intÃ©rieure.','1934','Comment je vois le monde','Albert Einstein'),(216,'Les Etats-Unis d\' AmÃ©rique forment un pays qui est passÃ© directement de la barbarie Ã  la dÃ©cadence, sans jamais avoir connu la civilisation.','','La culture du narcissisme','Albert Einstein'),(217,'Nâ€™essayez pas de devenir un homme qui a du succÃ¨s. Essayez de devenir un homme qui a de la valeur','','','Albert Einstein'),(218,'La science sans religion est boiteuse, la religion sans science est aveugle.','','','Albert Einstein'),(219,'Les Illuminatis ne sont, eux aussi, qu\'un rÃ©vÃ©lateur, une pierre d\'achoppement sur notre chemin puisqu\'il y a toujours eu les Illuminatis, ou, du moins, des personnes qui ont agi selon des principes similaires [â€¦] Les Illuminatis n\'auraient pas autant de puissance si les hommes ne se laissaient pas manipuler.','1995','Le Livre Jaune nÂ°5','Jan van Helsing'),(220,'(Au sujet des Illuminatis) C\'est la moindre des choses que dans les ordres faisant de la magie noire tous les documents soient codifiÃ©s dans une Ã©criture secrÃ¨te qui ne peut pas Ãªtre dÃ©chiffrÃ©e par des non-initiÃ©s [â€¦] C\'est en ce sens que les historiens matÃ©rialistes ont beaucoup Ã  apprendre, Ã  moins qu\'ils ne renoncent Ã  trouver toute la vÃ©ritÃ©.','1995','Le Livre Jaune nÂ°5','Jan van Helsing'),(221,'Une technologie plus avancÃ©e ne rendra pas plus aimable un homme qui ne pense qu\'Ã  dÃ©truire, c\'est mÃªme plutÃ´t le contraire qui risque de se produire.','1995','Le Livre Jaune nÂ°5','Jan van Helsing');
/*!40000 ALTER TABLE `quote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (19,'admin','77eb6daa5337b0116822ea4649ba529f57bb67846113c282f684548b7a3afcac');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-12-19 14:38:59
