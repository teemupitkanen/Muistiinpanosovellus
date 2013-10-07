INSERT INTO kayttaja (id, username, password) VALUES
  ('1','testi1', 'salainen'),
  ('2','testi2', 'salaisempi'),
  ('3','esim','esim');

SELECT setval('kayttaja_id_seq', 3);

INSERT INTO prioriteetti (tunnus,arvo,kayttaja,kuvaus) VALUES
  ('1','4', '1','ei kovin tärkeä'),
  ('2','9', '1','tosi tärkeä'),
  ('3','4', '2','aika tärkeä'),
  ('4','1', '2','turha'),
('5','0','3','oletus'),
('6','1','3','ei tärkeää'),
('7','3','3','vähän tärkeä'),
('8','5','3','kohtalaisen tärkeä'),
('9','7','3','tärkeä'),
('10','10','3','todella tärkeä'),
('11','1000','3','wou!');

SELECT setval('prioriteetti_tunnus_seq', 11);

INSERT INTO muistiinpano (tunnus, kayttaja, otsikko, sisalto, prioriteetti) VALUES
  ('1', '1','käy lenkillä','Muista käydä lenkillä Eskon kanssa','1'),
  ('2', '1','syö','Älä unohda syödä maksalaatikkoa jääkaapista','1'),
  ('3', '1','koe','Lue matikan tenttiin','2'),
  ('4', '2','katso breaking bad','Breaking bad tänään nelosella klo 21','3'),
  ('5', '2','mene nukkumaan','uni tekee hyvää jee jee','4'),
('6','3','Laman tentti','Koe ensi torstaina klo 16 exactumin auditoriossa','11'),
('7','3','Risteily','Risteily ruotsiin tiistaina klo 16','10'),
('8','3','lenkki','Käy aapon kanssa lenkillä! Lähtö liikuntakeskukselta to klo 19','9'),
('9','3','Syö maksalaatikko','Ruokaa jääkaapissa','9'),
('10','3','Tee laskarit','Muista tehdä loput matikan tehtävät','8'),
('11','3','syö','muista syödä illalla','7'),
('12','3','uutiset','uutiset kakkosella klo 19','7'),
('13','3','mene nukkumaan','...ti huomenna väsyttää','7'),
('14','3','dokumentaatio kuntoon','vai olisiko tärkeämpi?','5');
SELECT setval('muistiinpano_tunnus_seq', 14);

INSERT INTO luokka (tunnus, kayttaja, nimi) VALUES
  ('1', '1','koulujutut'),
  ('2', '1','liikunta'),
  ('3', '1','arki'),
  ('4', '2','tv'),
  ('5', '2','arki'),
('6','3','koulu'),
('7','3','syöminen'),
('8','3','harrastukset'),
('9','3','liikunta'),
('10','3','hupi'),
('11','3','oletus');
SELECT setval('luokka_tunnus_seq', 11);

INSERT INTO luokan_muistiinpano (tunnus, muistiinpano, luokka) VALUES
  ('1', '1','2'),
  ('2', '1','3'),
  ('3', '2','3'),
  ('4', '3','1'),
  ('5', '4','4'),
  ('6', '5','5'),
('7','6','6'),
('8','7','10'),
('9','8','8'),
('10','8','9'),
('11','9','7'),
('12','10','6'),
('13','10','10'),
('14','11','7'),
('15','12','11'),
('16','13','11'),
('17','14','6');
SELECT setval('luokan_muistiinpano_tunnus_seq', 17);


