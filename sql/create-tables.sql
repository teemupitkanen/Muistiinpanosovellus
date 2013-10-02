--käyttäjä-taulun luonti
CREATE TABLE kayttaja (
id serial PRIMARY KEY,
username varchar NOT NULL,
password varchar NOT NULL
);

--prioriteetti-taulun luonti
CREATE TABLE prioriteetti(
arvo integer,
kayttaja integer REFERENCES kayttaja(id),
kuvaus varchar,
PRIMARY KEY(arvo, kayttaja)
);

--luokka-taulun luonti
CREATE TABLE luokka(
tunnus integer PRIMARY KEY,
kayttaja integer REFERENCES kayttaja(id),
nimi varchar
);

--muistiinpano-taulun luonti
CREATE TABLE muistiinpano(
tunnus serial PRIMARY KEY,
kayttaja integer REFERENCES kayttaja(id),
otsikko varchar NOT NULL,
sisalto varchar,
prioriteetti integer,
FOREIGN KEY (prioriteetti, kayttaja) REFERENCES prioriteetti(arvo, kayttaja)
);

--luokan_muistiinpano-taulun luonti
CREATE TABLE luokan_muistiinpano(
tunnus serial PRIMARY KEY,
muistiinpano integer REFERENCES muistiinpano(tunnus),
luokka integer REFERENCES luokka(tunnus)
);
