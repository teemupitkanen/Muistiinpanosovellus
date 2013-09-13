INSERT INTO kayttaja (username, password) VALUES
  ('testi1', 'salainen'),
  ('testi2', 'salaisempi');

INSERT INTO muistilista (tunnus, kayttaja, määrä) VALUES
  ('testi1','1', '3'),
  ('testi2','2', '2');


INSERT INTO prioriteetti (arvo,muistilista,kuvaus) VALUES
  ('4', '1','ei kovin tärkeä'),
  ('90', '1','tosi tärkeä'),
  ('4', '2','aika tärkeä'),
  ('1', '2','turha');

INSERT INTO muistiinpano (tunnus, muistilista, otsikko, sisalto, prioriteetti) VALUES
  ('111', '1','käy lenkillä','Muista käydä lenkillä Eskon kanssa','4'),
  ('112', '1','syö','Älä unohda syödä maksalaatikkoa jääkaapista','4'),
  ('113', '1','koe','Lue matikan tenttiin','9'),
  ('121', '2','katso breaking bad','Breaking bad tänään nelosella klo 21','2'),
  ('122', '2','mene nukkumaan','uni tekee hyvää jee jee','2');

INSERT INTO luokka (tunnus, muistilista, nimi) VALUES
  ('11', '1','koulujutut'),
  ('12', '1','liikunta'),
  ('13', '1','arki'),
  ('21', '1','tv'),
  ('22', '1','arki');

INSERT INTO luokan_muistiinpano (tunnus, muistiinpano, luokka) VALUES
  ('1', '111','liikunta'),
  ('2', '111','arki'),
  ('3', '112','arki'),
  ('4', '113','koulu'),
  ('5', '121','tv'),
  ('5', '122','arki');



