--käyttäjä-taulun luonti
CREATE TABLE kayttaja (
id serial PRIMARY KEY,
username varchar NOT NULL,
password varchar NOT NULL
);

--muistilista-taulun luonti
CREATE TABLE muistilista(
tunnus serial PRIMARY KEY,
kayttaja integer REFERENCES kayttaja(id),
määrä integer
);

--prioriteetti-taulun luonti
CREATE TABLE prioriteetti(
arvo integer PRIMARY KEY,
muistilista integer REFERENCES muistilista(tunnus),
kuvaus varchar
);

--luokka-taulun luonti
CREATE TABLE luokka(
tunnus integer PRIMARY KEY,
muistilista integer REFERENCES muistilista(tunnus),
nimi varchar
);

--muistiinpano-taulun luonti
CREATE TABLE muistiinpano(
tunnus integer PRIMARY KEY,
muistilista integer REFERENCES muistilista(tunnus),
otsikko varchar NOT NULL,
sisalto varchar,
prioriteetti integer REFERENCES prioriteetti(arvo)
);

--luokan_muistiinpano-taulun luonti
CREATE TABLE luokan_muistiinpano(
tunnus integer PRIMARY KEY,
muistiinpano integer REFERENCES muistiinpano(tunnus),
luokka integer REFERENCES luokka(tunnus)
);

