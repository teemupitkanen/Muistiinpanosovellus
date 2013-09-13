--käyttäjä-taulun luonti
CREATE TABLE kayttaja (
username varchar PRIMARY KEY,
password varchar NOT NULL,
muistilista integer REFERENCES muistilista(tunnus)
);

--muistilista-taulun luonti
CREATE TABLE muistilista(
tunnus integer PRIMARY KEY,
määrä integer
);

--muistiinpano-taulun luonti
CREATE TABLE muistiinpano(
tunnus integer PRIMARY KEY,
muistilista integer REFERENCES muistilista(tunnus),
otsikko varchar NOT NULL,
sisalto varchar,
muokattu TIMESTAMP
);

--luokka-taulun luonti
CREATE TABLE luokka(
tunnus integer PRIMARY KEY,
muistilista integer REFERENCES muistilista(tunnus),
nimi varchar
);

--prioriteetti-taulun luonti
CREATE TABLE prioriteetti(
arvo integer PRIMARY KEY,
muistilista integer REFERENCES muistilista(tunnus),
kuvaus varchar
);

--luokan_muistiinpano-taulun luonti
CREATE TABLE luokan_muistiinpano(
tunnus integer PRIMARY KEY,
muistiinpano integer REFERENCES muistiinpano(tunnus),
luokka integer REFERENCES luokka(tunnus)
);

