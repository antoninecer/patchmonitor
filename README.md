PatchMonitor
popis aplikace:
uzivatelum, kteri chteji odkontrolovat stav patch updatu u svych serveru slouzi webovy portal
http://patchmonitor.sos.kb.cz/

Zucastnenym - superuserum / administratorum , kteri ovladaji prubeh patche vkladanim vyjimek slouzi jiz aplikace po prihlaseni na strance
http://patchmonitor.sos.kb.cz/login.php

zde lze pridavat/odebirat vyjimky ktere servery nebudou patchovany automatem
Pouze admini mohou odebirat jiz hotove procesy - pro ucel ladeni

jinak mame 3 urovne uzivatelu v tabulce users ve sloupecku admin 
Y - je administrator, muze vse, co nabizi aplikace
S - je superuser, muze vkladat/ odebirat vyjimky
N - obycejny uzivatel, muze pouze nahlizet


--------------------------------


1. instalace LAMP serveru Apache Mysql(mariadb) a PHP(7.1) a kontrola, ze index.php je v automaticky prohlizenych strankach

2. naplneni sql udaji z sql/inventory.sql

3. odkopirovani adresare www do /var/www/html

4. v playbooks jsou inventary.yml a deletetable.yml pro ovladani dat v MariaDB
priklady pouziti

#zaplneni tabulky inventory

ansible-playbook  playbooks/inventary.yml -i inventory  -u a57uc4 --ask-pass --ask-become-pass --vault-password-file vault_pass.txt -e tabulka=inventory 

#zaplneni tabulky proces

K zaplnění tabulky process dochází automaticky při updatovacím patchi jinak lza vyvolat

ansible-playbook  playbooks/inventary.yml -i inventory  -u a57uc4 --ask-pass --ask-become-pass --vault-password-file vault_pass.txt -e tabulka=proces -e hotovo=YES

zatim rozlisuji jen 2 ruzne stavy hotovo

            if ($row['hotovo'] == 'YES') {
            $tr="<td bgcolor='#03fc4e'>";
            }
            elseif ($row['hotovo'] == 'obsolete') {
            $tr="<td bgcolor='#EA7AEB'>";
            }
            else {
            $tr= "<td bgcolor='#fcdb03'>";
            }

takze pokud je to YES, pak to sviti zelene, pokud je to obsolete, tak je to fialove a jinak je to zlute


#odmazani tabulky proces

ansible-playbook playbooks/deletetable.yml -i inventory -l localhost -u tonda --ask-pass --ask-become-pass -e tabulka=proces

#odmazani tabulky inventory

ansible-playbook playbooks/deletetable.yml -i inventory -l localhost -u tonda --ask-pass --ask-become-pass -e tabulka=inventory

momentalne jsem rozbehl na cv38x136 

http://patchmonitor.sos.kb.cz/ - zde odkontrolovat stav - pred patchovkou odmazat process a inventory a naplnit inventory
pokud za lomitko date ?sql= sql sintaxi za select * from table 
treba http://patchmonitor.sos.kb.cz/?sql= order by 1

