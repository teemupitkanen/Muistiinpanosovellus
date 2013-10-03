INSERT INTO kayttaja (id, username, password) VALUES
  ('1','testi1', 'salainen'),
  ('2','testi2', 'salaisempi');

SELECT setval('kayttaja_id_seq', 2);

INSERT INTO prioriteetti (tunnus,arvo,kayttaja,kuvaus) VALUES
  ('1','4', '1','ei kovin tärkeä'),
  ('2','9', '1','tosi tärkeä'),
  ('3','4', '2','aika tärkeä'),
  ('4','1', '2','turha');
SELECT setval('prioriteetti_tunnus_seq', 4);

INSERT INTO muistiinpano (tunnus, kayttaja, otsikko, sisalto, prioriteetti) VALUES
  ('1', '1','käy lenkillä','Muista käydä lenkillä Eskon kanssa','1'),
  ('2', '1','syö','Älä unohda syödä maksalaatikkoa jääkaapista','1'),
  ('3', '1','koe','Lue matikan tenttiin','2'),
  ('4', '2','katso breaking bad','Breaking bad tänään nelosella klo 21','3'),
  ('5', '2','mene nukkumaan','uni tekee hyvää jee jee','4');
SELECT setval('muistiinpano_tunnus_seq', 5);

INSERT INTO luokka (tunnus, kayttaja, nimi) VALUES
  ('1', '1','koulujutut'),
  ('2', '1','liikunta'),
  ('3', '1','arki'),
  ('4', '2','tv'),
  ('5', '2','arki');
SELECT setval('luokka_tunnus_seq', 5);

INSERT INTO luokan_muistiinpano (tunnus, muistiinpano, luokka) VALUES
  ('1', '1','2'),
  ('2', '1','3'),
  ('3', '2','3'),
  ('4', '3','1'),
  ('5', '4','4'),
  ('6', '5','5');
SELECT setval('luokan_muistiinpano_tunnus_seq', 6);


