INSERT INTO kayttaja (id, username, password) VALUES
  ('1','testi1', 'salainen'),
  ('2','testi2', 'salaisempi');

INSERT INTO muistilista (tunnus, kayttaja, määrä) VALUES
  ('1','1', '3'),
  ('2','2', '2');


INSERT INTO prioriteetti (arvo,muistilista,kuvaus) VALUES
  ('4', '1','ei kovin tärkeä'),
  ('9', '1','tosi tärkeä'),
  ('4', '2','aika tärkeä'),
  ('1', '2','turha');

INSERT INTO muistiinpano (tunnus, muistilista, otsikko, sisalto, prioriteetti) VALUES
  ('111', '1','käy lenkillä','Muista käydä lenkillä Eskon kanssa','4'),
  ('112', '1','syö','Älä unohda syödä maksalaatikkoa jääkaapista','4'),
  ('113', '1','koe','Lue matikan tenttiin','9'),
  ('121', '2','katso breaking bad','Breaking bad tänään nelosella klo 21','4'),
  ('122', '2','mene nukkumaan','uni tekee hyvää jee jee','1');

INSERT INTO luokka (tunnus, muistilista, nimi) VALUES
  ('11', '1','koulujutut'),
  ('12', '1','liikunta'),
  ('13', '1','arki'),
  ('21', '2','tv'),
  ('22', '2','arki');

INSERT INTO luokan_muistiinpano (tunnus, muistiinpano, luokka) VALUES
  ('1', '111','12'),
  ('2', '111','13'),
  ('3', '112','13'),
  ('4', '113','11'),
  ('5', '121','21'),
  ('6', '122','22');



