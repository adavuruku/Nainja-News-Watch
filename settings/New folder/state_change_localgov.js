//change of sates and department begin here
    function byId(e)
    {
        return document.getElementById(e);
    }
 function samedetails1() 
{ 
			if (byId('samedetails').checked ==true)
			{
				//retrieve from personal details
				var value1 = byId('c_address').value;
				if (value1 !="")
				{
					//load in to guardian boxes
					byId('c_paddress').value = value1;
				}
			}
			else
			{
				byId('c_paddress').value = "";
			}
			
}
 
    function stateComboChange()
    {
        //document.getElementById("err8").innerHTML="";
        //document.firstform.sorigin.style.border="0px solid #ff0000";
        //alert ("sherif");
        var combo1 = byId('cmbstate');
        var combo2 = byId('cmblgov');
    //alert(combo1.value);

        emptyCombo(combo2);
        switch(combo1.value)
        {
            case '-select state-':  addOption(combo2, '-select Local Govt-', '-select Local Govt-');
                        break;
        case 'Abuja':  addOption(combo2, 'Gwagwalada', 'Gwagwalada');
                        addOption(combo2, 'Kuje', 'Kuje');
                        addOption(combo2, 'Abaji', 'Abaji');
                        addOption(combo2, 'Abuja Municipal', 'Abuja Municipal');
                        addOption(combo2, 'Bwari', 'Bwari');
                        addOption(combo2, 'Kwali', 'Kwali');
                        break;
        case 'Abia':  addOption(combo2, 'Aba South', 'Aba South');
                        addOption(combo2, 'Aba North', 'Aba North');
                        addOption(combo2, 'Arochukwu', 'Arochukwu');
                        addOption(combo2, 'Bende', 'Bende');
                        addOption(combo2, 'Ikwuano', 'Ikwuano');
                        addOption(combo2, 'Isiala-Ngwa North', 'Isiala-Ngwa North');
                        addOption(combo2, 'Isiala-Ngwa South', 'Isiala-Ngwa South');
                        addOption(combo2, 'Isuikwato', 'Isuikwato');
                        addOption(combo2, 'Obi Nwa', 'Obi Nwa');
                        addOption(combo2, 'Ohafia', 'Ohafia');
                        addOption(combo2, 'Osisioma', 'Osisioma');
                        addOption(combo2, 'Ngwa', 'Ngwa');
                        addOption(combo2, 'Ugwunagbo', 'Ugwunagbo');
                        addOption(combo2, 'Ukwa East', 'Ukwa East');
                        addOption(combo2, 'Ukwa West', 'Ukwa West');
                        addOption(combo2, 'Umuahia North', 'Umuahia North');
                        addOption(combo2, 'Umuahia South', 'Umuahia South');
                        addOption(combo2, 'Umu-Neochi', 'Umu-Neochi');
                        break;
        case 'Adamawa':  addOption(combo2, 'Demsa', 'Demsa');
                        addOption(combo2, 'Fufore', 'Fufore');
                        addOption(combo2, 'Ganaye', 'Ganaye');
                        addOption(combo2, 'Gireri', 'Gireri');
                        addOption(combo2, 'Gombi', 'Gombi');
                        addOption(combo2, 'Guyuk', 'Guyuk');
                        addOption(combo2, 'Hong', 'Hong');
                        addOption(combo2, 'Jada', 'Jada');
                        addOption(combo2, 'Lamurde', 'Lamurde');
                        addOption(combo2, 'Madagali', 'Madagali');
                        addOption(combo2, 'Maiha', 'Maiha');
                        addOption(combo2, 'Mayo-Belwa', 'Mayo-Belwa');
                        addOption(combo2, 'Michika', 'Michika');
                        addOption(combo2, 'Mubi North', 'Mubi North');
                        addOption(combo2, 'Mubi South', 'Mubi South');
                        addOption(combo2, 'Numan', 'Numan');
                        addOption(combo2, 'Shelleng', 'Shelleng');
                        addOption(combo2, 'Song', 'Song');
                        addOption(combo2, 'Toungo', 'Toungo');
                        addOption(combo2, 'Yola North', 'Yola North');
                        addOption(combo2, 'Yola South', 'Yola South');
                        break;
        case 'Akwa Ibom': addOption(combo2, 'Abak', 'Abak');
                        addOption(combo2, 'Eastern Obolo', 'Eastern Obolo');
                        addOption(combo2, 'Eket', 'Eket');
                        addOption(combo2, 'Esit Eket', 'Esit Eket');
                        addOption(combo2, 'Essien Udim', 'Essien Udim');
                        addOption(combo2, 'Etim Ekpo', 'Etim Ekpo');
                        addOption(combo2, 'Etinan', 'Etinan');
                        addOption(combo2, 'Ibeno', 'Ibeno');
                        addOption(combo2, 'Ibesikpo Asutan', 'Ibesikpo Asutan');
                        addOption(combo2, 'Ibiono Ibom', 'Ibiono Ibom');
                        addOption(combo2, 'Ika', 'Ika');
                        addOption(combo2, 'Ikono', 'Ikono');
                        addOption(combo2, 'Ikot Abasi', 'Ikot Abasi');
                        addOption(combo2, 'Ikot Ekpene', 'Ikot Ekpene');
                        addOption(combo2, 'Ini', 'Ini');
                        addOption(combo2, 'Itu', 'Itu');
                        addOption(combo2, 'Mbo', 'Mbo');
                        addOption(combo2, 'Mkpat Enin', 'Mkpat Enin');
                        addOption(combo2, 'Nsit Atai', 'Nsit Atai');
                        addOption(combo2, 'Nsit Ibom', 'Nsit Ibom');
                        addOption(combo2, 'Nsit Ubium', 'Nsit Ubium');
                        addOption(combo2, 'Obot Akara', 'Obot Akara');
                        addOption(combo2, 'Okobo', 'Okobo');
                        addOption(combo2,  'Onna', 'Onna');
                        addOption(combo2, 'Oron', 'Oron');
                        addOption(combo2,  'Oruk Anam', 'Oruk Anam');
                        addOption(combo2, 'Udung Uko', 'Udung Uko');
                        addOption(combo2, 'Ukanafun', 'Ukanafun');
                        addOption(combo2, 'Uruan', 'Uruan');
                        addOption(combo2, 'Urue-Offong/Oruko', 'Urue-Offong/Oruko');
                        addOption(combo2, 'Uyo', 'Uyo');
                        break;
                        
        case 'Anambra':  addOption(combo2, 'Aguata', 'Aguata');
                        addOption(combo2, 'Anambra East', 'Anambra East');
                        addOption(combo2, 'Anambra West', 'Anambra West');
                        addOption(combo2, 'Anaocha', 'Anaocha');
                         addOption(combo2, 'Awka North', 'Awka North');
                        addOption(combo2, 'Awka South', 'Awka South');
                        addOption(combo2, 'Ayamelum', 'Ayamelum');
                        addOption(combo2, 'Dunukofia', 'Dunukofia');
                        addOption(combo2, 'Ekwusigo', 'Ekwusigo');
                        addOption(combo2, 'Idemili North', 'Idemili North');
                        addOption(combo2, 'Idemili south', 'Idemili south');
                         addOption(combo2, 'Ihiala', 'Ihiala');
                        addOption(combo2, 'Njikoka', 'Njikoka');
                        addOption(combo2, 'Nnewi North', 'Nnewi North');
                        addOption(combo2, 'Nnewi South', 'Nnewi South');
                        addOption(combo2,  'Ogbaru', 'Ogbaru');
                        addOption(combo2, 'Onitsha North', 'Onitsha North');
                        addOption(combo2, 'Onitsha South', 'Onitsha South');
                         addOption(combo2,  'Orumba North', 'Orumba North');
                        addOption(combo2, 'Orumba South', 'Orumba South');
                        addOption(combo2, 'Oyi', 'Oyi');
                         break;
        case 'Bauchi':  addOption(combo2, 'Alkaleri', 'Alkaleri');
                        addOption(combo2, 'Bauchi', 'Bauchi');
                        addOption(combo2, 'Bogoro', 'Bogoro');
                        addOption(combo2, 'Damban', 'Damban');
                        addOption(combo2, 'Darazo', 'Darazo');
                        addOption(combo2, 'Dass', 'Dass');
                        addOption(combo2, 'Ganjuwa', 'Ganjuwa');
                        addOption(combo2, 'Giade', 'Giade');
                         addOption(combo2, 'Itas/Gadau', 'Itas/Gadau');
                        addOption(combo2, "Jama/'are", "Jama/'are");
                        addOption(combo2, 'Katagum', 'Katagum');
                        addOption(combo2, 'Kirfi', 'Kirfi');
                        addOption(combo2, 'Misau', 'Misau');
                        addOption(combo2, 'Ningi', 'Ningi');
                         addOption(combo2, 'Shira', 'Shira');
                        addOption(combo2, 'Tafawa-Balewa', 'Tafawa-Balewa');
                        addOption(combo2, 'Toro', 'Toro');
                        addOption(combo2, 'Warji', 'Warji');
                        addOption(combo2, 'Zaki', 'Zaki');
                        break;
        case 'Bayelsa':  addOption(combo2, 'Brass', 'Brass');
                        addOption(combo2, 'Ekeremor', 'Ekeremor');
                        addOption(combo2, 'Kolokuma/Opokuma', 'Kolokuma/Opokuma');
                        addOption(combo2, 'Nembe', 'Nembe');
                        addOption(combo2, 'Ogbia', 'Ogbia');
                        addOption(combo2, 'Sagbama', 'Sagbama');
                        addOption(combo2, 'Southern Jaw', 'Southern Jaw');
                        addOption(combo2, 'Yenegoa', 'Yenegoa');
                        break;
        case 'Benue':  addOption(combo2, 'Ado', 'Ado');
                        addOption(combo2, 'Agatu', 'Agatu');
                        addOption(combo2, 'Apa', 'Apa');
                        addOption(combo2, 'Buruku', 'Buruku');
                        addOption(combo2, 'Gboko', 'Gboko');
                        addOption(combo2, 'Guma', 'Guma');
                        addOption(combo2, 'Gwer East', 'Gwer East');
                        addOption(combo2, 'Gwer West', 'Gwer West');
                        addOption(combo2, 'Katsina-Ala', 'Katsina-Ala');
                        addOption(combo2, 'Konshisha', 'Konshisha');
                        addOption(combo2, 'Kwande', 'Kwande');
                        addOption(combo2, 'Logo', 'Logo');
                        addOption(combo2, 'Makurdi', 'Makurdi');
                        addOption(combo2, 'Obi', 'Obi');
                        addOption(combo2, 'Ogbadibo', 'Ogbadibo');
                        addOption(combo2, 'Oju', 'Oju');
                        addOption(combo2, 'Okpokwu', 'Okpokwu');
                        addOption(combo2, 'Ohimini', 'Ohimini');
                        addOption(combo2,  'Oturkpo', 'Oturkpo');
                        addOption(combo2, 'Tarka', 'Tarka');
                        addOption(combo2, 'Ukum', 'Ukum');
                        addOption(combo2, 'Ushongo', 'Ushongo');
                        addOption(combo2, 'Vandeikya', 'Vandeikya');
                        break;
        case 'Bornu':  addOption(combo2, 'Abadam', 'Abadam');
                        addOption(combo2, 'Askira/Uba', 'Askira/Uba');
                        addOption(combo2, 'Bama', 'Bama');
                        addOption(combo2, 'Bayo', 'Bayo');
                        addOption(combo2, 'Biu', 'Biu');
                        addOption(combo2, 'Chibok', 'Chibok');
                        addOption(combo2,  'Damboa', 'Damboa');
                        addOption(combo2, 'Dikwa', 'Dikwa');
                        addOption(combo2, 'Gubio', 'Gubio');
                        addOption(combo2, 'Guzamala', 'Guzamala');
                        addOption(combo2, 'Gwoza', 'Gwoza');
                        addOption(combo2, 'Hawul', 'Hawul');
                        addOption(combo2, 'Jere', 'Jere');
                        addOption(combo2, 'Kaga', 'Kaga');
                        addOption(combo2,  'Kala/Balge', 'Kala/Balge');
                        addOption(combo2, 'Konduga', 'Konduga');
                        addOption(combo2, 'Kukawa', 'Kukawa');
                        addOption(combo2, 'Kwaya Kusar', 'Kwaya Kusar');
                        addOption(combo2, 'Mafa', 'Mafa');
                        addOption(combo2, 'Magumeri', 'Magumeri');
                        addOption(combo2, 'Maiduguri', 'Maiduguri');
                        addOption(combo2, 'Marte', 'Marte');
                        addOption(combo2, 'Mobbar', 'Mobbar');
                        addOption(combo2, 'Monguno', 'Monguno');
                        addOption(combo2, 'Ngala', 'Ngala');
                        addOption(combo2, 'Nganzai', 'Nganzai');
                        addOption(combo2, 'Shani', 'Shani');
                        break;
    case 'Cross River':  addOption(combo2, 'Akpabuyo', 'Akpabuyo');
                        addOption(combo2,  'Odukpani', 'Odukpani');
                        addOption(combo2, 'Akamkpa', 'Akamkpa');
                        addOption(combo2, 'Biase', 'Biase');
                        addOption(combo2, 'Abi', 'Abi');
                        addOption(combo2, 'Ikom', 'Ikom');
                        addOption(combo2, 'Yarkur', 'Yarkur');
                        addOption(combo2,  'Odubra', 'Odubra');
                        addOption(combo2, 'Boki', 'Boki');
                        addOption(combo2, 'Ogoja', 'Ogoja');
                        addOption(combo2, 'Yala', 'Yala');
                        addOption(combo2, 'Obanliku', 'Obanliku');
                        addOption(combo2, 'Obudu', 'Obudu');
                        addOption(combo2, 'Calabar South', 'Calabar South');
                        addOption(combo2, 'Etung', 'Etung');
                        addOption(combo2,  'Bekwara', 'Bekwara');
                        addOption(combo2, 'Bakassi', 'Bakassi');
                        addOption(combo2, 'Calabar Municipality', 'Calabar Municipality');
                        break;
        case 'Delta':  addOption(combo2, 'Oshimili', 'Oshimili');
                        addOption(combo2, 'Aniocha', 'Aniocha');
                        addOption(combo2, 'Aniocha South', 'Aniocha South');
                        addOption(combo2, 'Ika South', 'Ika South');
                        addOption(combo2, 'Ika North-East', 'Ika North-East');
                        addOption(combo2,  'Ndokwa West', 'Ndokwa West');
                        addOption(combo2, 'Ndokwa East', 'Ndokwa East');
                        addOption(combo2, 'Isoko south', 'Isoko south');
                        addOption(combo2, 'Isoko North', 'Isoko North');
                        addOption(combo2, 'Bomadi', 'Bomadi');
                        addOption(combo2, 'Burutu', 'Burutu');
                        addOption(combo2, 'Ughelli South', 'Ughelli South');
                        addOption(combo2, 'Ughelli North', 'Ughelli North');
                        addOption(combo2, 'Ethiope West', 'Ethiope West');
                        addOption(combo2, 'Ethiope East', 'Ethiope East');
                        addOption(combo2,  'Sapele', 'Sapele');
                        addOption(combo2, 'Okpe', 'Okpe');
                        addOption(combo2, 'Warri North', 'Warri North');
                        addOption(combo2, 'Warri South', 'Warri South');
                        addOption(combo2, 'Uvwie', 'Uvwie');
                        addOption(combo2, 'Udu', 'Udu');
                        addOption(combo2, 'Warri Central', 'Warri Central');
                        addOption(combo2, 'Ukwani', 'Ukwani');
                        addOption(combo2,  'Oshimili North', 'Oshimili North');
                        addOption(combo2, 'Patani', 'Patani');
                        break;
        case 'Ebonyi':  addOption(combo2, 'Afikpo South', 'Afikpo South');
                        addOption(combo2, 'Afikpo North', 'Afikpo North');
                        addOption(combo2, 'Onicha', 'Onicha');
                        addOption(combo2, 'Ohaozara', 'Ohaozara');
                        addOption(combo2, 'Abakaliki', 'Abakaliki');
                        addOption(combo2, 'Ishielu', 'Ishielu');
                        addOption(combo2, 'lkwo', 'lkwo');
                        addOption(combo2, 'Ezza', 'Ezza');
                        addOption(combo2, 'Ezza South', 'Ezza South');
                        addOption(combo2, 'Ohaukwu', 'Ohaukwu');
                        addOption(combo2, 'Ebonyi', 'Ebonyi');
                        addOption(combo2,  'Ivo', 'Ivo');
                        break;            
            case 'Edo':  addOption(combo2, 'Esan North-East', 'Esan North-East');
                        addOption(combo2, 'Esan Central', 'Esan Central');
                        addOption(combo2, 'Esan West', 'Esan West');
                        addOption(combo2,  'Egor', 'Egor');
                        addOption(combo2, 'Ukpoba', 'Ukpoba');
                        addOption(combo2, 'Central', 'Central');
                        addOption(combo2, 'Etsako Central', 'Etsako Central');
                        addOption(combo2, 'Igueben', 'Igueben');
                        addOption(combo2, 'Oredo', 'Oredo');
                        addOption(combo2, 'Ovia South-West', 'Ovia South-West');
                        addOption(combo2, 'Ovia South-East', 'Ovia South-East');
                        addOption(combo2, 'Orhionwon', 'Orhionwon');
                        addOption(combo2, 'Uhunmwonde', 'Uhunmwonde');
                        addOption(combo2, 'Etsako East', 'Etsako East');
                        addOption(combo2, 'Esan South-East', 'Esan South-East');
                        break;
        case 'Ekiti':  addOption(combo2, 'Ado', 'Ado');
                        addOption(combo2, 'Ekiti-East', 'Ekiti-East');
                        addOption(combo2, 'Ekiti-West', 'Ekiti-West');
                        addOption(combo2,  'Emure/Ise/Orun', 'Emure/Ise/Orun');
                        addOption(combo2, 'Ekiti South-West', 'Ekiti South-West');
                        addOption(combo2, 'Ikare', 'Ikare');
                        addOption(combo2, 'Irepodun', 'Irepodun');
                        addOption(combo2, 'Ijero', 'Ijero');
                        addOption(combo2, 'Ido/Osi', 'Ido/Osi');
                        addOption(combo2, 'Oye', 'Oye');
                        addOption(combo2, 'Ikole', 'Ikole');
                        addOption(combo2, 'Moba', 'Moba');
                        addOption(combo2,  'Gbonyin', 'Gbonyin');
                        addOption(combo2,  'Efon', 'Efon');
                        addOption(combo2, 'Ise/Orun', 'Ise/Orun');
                        addOption(combo2, 'Ilejemeje', 'Ilejemeje');
                        break;
        case 'Enugu':  addOption(combo2, 'Enugu South', 'Enugu South');
                        addOption(combo2, 'Igbo-Eze South', 'Igbo-Eze South');
                        addOption(combo2, 'Enugu North', 'Enugu North');
                        addOption(combo2,  'Nkanu', 'Nkanu');
                        addOption(combo2, 'Udi Agwu', 'Udi Agwu');
                        addOption(combo2, 'Oji-River', 'Oji-River');
                        addOption(combo2, 'Ezeagu', 'Ezeagu');
                        addOption(combo2, 'IgboEze North', 'IgboEze North');
                        addOption(combo2, 'Isi-Uzo', 'Isi-Uzo');
                        addOption(combo2, 'Nsukka', 'Nsukka');
                        addOption(combo2, 'Igbo-Ekiti', 'Igbo-Ekiti');
                        addOption(combo2, 'Uzo-Uwani', 'Uzo-Uwani');
                        addOption(combo2, 'Enugu East', 'Enugu East');
                        addOption(combo2, 'Aninri', 'Aninri');
                        addOption(combo2, 'Nkanu East', 'Nkanu East');
                        addOption(combo2, 'Udenu', 'Udenu');
                        break;
        case 'Gombe':  addOption(combo2, 'Akko', 'Akko');
                        addOption(combo2, 'Balanga', 'Balanga');
                        addOption(combo2, 'Billiri', 'Billiri');
                        addOption(combo2, 'Dukku', 'Dukku');
                        addOption(combo2, 'Kaltungo', 'Kaltungo');
                        addOption(combo2, 'Kwami', 'Kwami');
                        addOption(combo2, 'Shomgom', 'Shomgom');
                        addOption(combo2, 'Funakaye', 'Funakaye');
                        addOption(combo2, 'Gombe', 'Gombe');
                        addOption(combo2,  'Nafada/Bajoga', 'Nafada/Bajoga');
                        addOption(combo2, 'Yamaltu/Delta', 'Yamaltu/Delta');
                        break;
        case 'Imo':  addOption(combo2, 'Aboh-Mbaise', 'Aboh-Mbaise');
                        addOption(combo2, 'Ahiazu-Mbaise', 'Ahiazu-Mbaise');
                        addOption(combo2, 'Ehime-Mbano', 'Ehime-Mbano');
                        addOption(combo2, 'Ezinihitte', 'Ezinihitte');
                        addOption(combo2, 'Ideato North', 'Ideato North');
                        addOption(combo2, 'Ideato South', 'Ideato South');
                        addOption(combo2, 'Ihitte/Uboma', 'Ihitte/Uboma');
                        addOption(combo2,  'Ikeduru', 'Ikeduru');
                        addOption(combo2, 'Isiala Mbano', 'Isiala Mbano');
                        addOption(combo2, 'Isu', 'Isu');
                        addOption(combo2,  'Mbaitoli', 'Mbaitoli');
                        addOption(combo2, 'Ngor-Okpala', 'Ngor-Okpala');
                        addOption(combo2, 'Njaba', 'Njaba');
                        addOption(combo2, 'Nwangele', 'Nwangele');
                        addOption(combo2, 'Nkwerre', 'Nkwerre');
                        addOption(combo2, 'Obowo', 'Obowo');
                        addOption(combo2,  'Oguta', 'Oguta');
                        addOption(combo2, 'Ohaji/Egbema', 'Ohaji/Egbema');
                        addOption(combo2, 'Okigwe', 'Okigwe');
                        addOption(combo2, 'Orlu', 'Orlu');
                        addOption(combo2, 'Orsu', 'Orsu');
                        addOption(combo2, 'Oru East', 'Oru East');
                        addOption(combo2, 'Oru West', 'Oru West');
                        addOption(combo2, 'Owerri-Municipal', 'Owerri-Municipal');
                        addOption(combo2, 'Owerri North', 'Owerri North');
                        addOption(combo2,  'Owerri West', 'Owerri West');
                        break;
        case 'Jigawa': addOption(combo2, 'Auyo', 'Auyo');
                        addOption(combo2, 'Babura', 'Babura');
                        addOption(combo2, 'Birni Kudu', 'Birni Kudu');
                        addOption(combo2, 'Biriniwa', 'Biriniwa');
                        addOption(combo2, 'Buji', 'Buji');
                        addOption(combo2, 'Dutse', 'Dutse');
                        addOption(combo2,  'Gagarawa', 'Gagarawa');
                        addOption(combo2, 'Garki', 'Garki');
                        addOption(combo2, 'Gumel', 'Gumel');
                        addOption(combo2, 'Guri', 'Guri');
                        addOption(combo2, 'Gwaram', 'Gwaram');
                        addOption(combo2, 'Gwiwa', 'Gwiwa');
                        addOption(combo2, 'Hadejia', 'Hadejia');
                        addOption(combo2, 'Jahun', 'Jahun');
                        addOption(combo2, 'Kafin Hausa', 'Kafin Hausa');
                        addOption(combo2, 'Kaugama Kazaure', 'Kaugama Kazaure');
                        addOption(combo2, 'Kiri Kasamma', 'Kiri Kasamma');
                        addOption(combo2, 'Kiyawa', 'Kiyawa');
                        addOption(combo2, 'Maigatari', 'Maigatari');
                        addOption(combo2, 'Malam Madori', 'Malam Madori');
                        addOption(combo2, 'Miga', 'Miga');
                        addOption(combo2, 'Ringim', 'Ringim');
                        addOption(combo2, 'Roni', 'Roni');
                        addOption(combo2, 'Sule-Tankarkar', 'Sule-Tankarkar');
                        addOption(combo2, 'Taura', 'Taura');
                        addOption(combo2, 'Yankwashi', 'Yankwashi');
                        break;
        case 'Kaduna':  addOption(combo2,  'Birni-Gwari', 'Birni-Gwari');
                        addOption(combo2, 'Chikun', 'Chikun');
                        addOption(combo2, 'Giwa', 'Giwa');
                        addOption(combo2, 'Igabi', 'Igabi');
                        addOption(combo2,  'Ikara', 'Ikara');
                        addOption(combo2, 'jaba', 'jaba');
                        addOption(combo2,  "Jema/'a", "Jema/'a");
                        addOption(combo2,  'Kachia', 'Kachia');
                        addOption(combo2, 'Kaduna North', 'Kaduna North');
                        addOption(combo2, 'Kaduna South', 'Kaduna South');
                        addOption(combo2, 'Kagarko', 'Kagarko');
                        addOption(combo2,  'Kajuru', 'Kajuru');
                        addOption(combo2,  'Kaura', 'Kaura');
                        addOption(combo2, 'Kubau', 'Kubau');
                        addOption(combo2, 'Kudan', 'Kudan');
                        addOption(combo2, 'Lere', 'Lere');
                        addOption(combo2,  'Makarfi', 'Makarfi');
                        addOption(combo2, 'Sabon-Gari', 'Sabon-Gari');
                        addOption(combo2, 'Sanga', 'Sanga');
                        addOption(combo2, 'Soba', 'Soba');
                        addOption(combo2, 'Zango-Kataf', 'Zango-Kataf');
                        addOption(combo2, 'Zaria', 'Zaria');
                        break;
        case 'Kano':  addOption(combo2, 'Ajingi', 'Ajingi');
                        addOption(combo2, 'Albasu', 'Albasu');
                        addOption(combo2, 'Bagwai', 'Bagwai');
                        addOption(combo2,  'Bebeji', 'Bebeji');
                        addOption(combo2, 'Bichi', 'Bichi');
                        addOption(combo2, 'Bunkure', 'Bunkure');
                        addOption(combo2, 'Dala', 'Dala');
                        addOption(combo2, 'Dambatta', 'Dambatta');
                        addOption(combo2, 'Dawakin Kudu', 'Dawakin Kudu');
                        addOption(combo2, 'Dawakin Tofa', 'Dawakin Tofa');
                        addOption(combo2, 'Doguwa', 'Doguwa');
                        addOption(combo2, 'Fagge', 'Fagge');
                        addOption(combo2, 'Gabasawa', 'Gabasawa');
                        addOption(combo2, 'Garko', 'Garko');
                        addOption(combo2, 'Garum', 'Garum');
                        addOption(combo2, 'Mallam', 'Mallam');
                        addOption(combo2, 'Gaya', 'Gaya');
                        addOption(combo2, 'Gezawa', 'Gezawa');
                        addOption(combo2, 'Gwale', 'Gwale');
                        addOption(combo2, 'Gwarzo', 'Gwarzo');
                        addOption(combo2, 'Kabo', 'Kabo');
                        addOption(combo2, 'Kano Municipal', 'Kano Municipal');
                        addOption(combo2, 'Karaye', 'Karaye');
                        addOption(combo2, 'Kibiya', 'Kibiya');
                        addOption(combo2, 'Kiru', 'Kiru');
                        addOption(combo2, 'kumbotso', 'kumbotso');
                        addOption(combo2, 'Kunchi', 'Kunchi');
                        addOption(combo2, 'Kura', 'Kura');
                        addOption(combo2, 'Madobi', 'Madobi');
                        addOption(combo2, 'Makoda', 'Makoda');
                        addOption(combo2, 'Minjibir', 'Minjibir');
                        addOption(combo2, 'Nasarawa', 'Nasarawa');
                        addOption(combo2, 'Rano', 'Rano');
                        addOption(combo2, 'Rimin Gado', 'Rimin Gado');
                        addOption(combo2, 'Rogo', 'Rogo');
                        addOption(combo2, 'Shanono', 'Shanono');
                        addOption(combo2, 'Sumaila', 'Sumaila');
                        addOption(combo2, 'Takali', 'Takali');
                        addOption(combo2,  'Tarauni', 'Tarauni');
                        addOption(combo2, 'Tofa', 'Tofa');
                        addOption(combo2,  'Tsanyawa', 'Tsanyawa');
                        addOption(combo2, 'Tudun Wada', 'Tudun Wada');
                        addOption(combo2, 'Ungogo', 'Ungogo');
                        addOption(combo2,  'Warawa', 'Warawa');
                        addOption(combo2, 'Wudil', 'Wudil');
                        break;
        case 'Katsina':  addOption(combo2, 'Bakori', 'Bakori');
                        addOption(combo2, 'Batagarawa', 'Batagarawa');
                        addOption(combo2, 'Batsari', 'Batsari');
                        addOption(combo2, 'Baure', 'Baure');
                        addOption(combo2, 'Bindawa', 'Bindawa');
                        addOption(combo2, 'Charanchi', 'Charanchi');
                        addOption(combo2, 'Dandume', 'Dandume');
                        addOption(combo2, 'Danja', 'Danja');
                        addOption(combo2, 'Dan Musa', 'Dan Musa');
                        addOption(combo2, 'Daura', 'Daura');
                        addOption(combo2, 'Dutsi', 'Dutsi');
                        addOption(combo2,  'Dutsin-Ma', 'Dutsin-Ma');
                        addOption(combo2, 'Faskari', 'Faskari');
                        addOption(combo2, 'Funtua', 'Funtua');
                        addOption(combo2, 'Ingawa', 'Ingawa');
                        addOption(combo2, 'Jibia', 'Jibia');
                        addOption(combo2, 'Kafur', 'Kafur');
                        addOption(combo2, 'Kaita', 'Kaita');
                        addOption(combo2, 'Kankara', 'Kankara');
                        addOption(combo2,  'Kankia', 'Kankia');
                        addOption(combo2, 'Katsina', 'Katsina');
                        addOption(combo2,  'Kurfi', 'Kurfi');
                        addOption(combo2, 'Kusada', 'Kusada');
                        addOption(combo2, "Mai/'Adua", "Mai/'Adua");
                        addOption(combo2, 'Malumfashi', 'Malumfashi');
                        addOption(combo2, 'Mani', 'Mani');
                        addOption(combo2, 'Mashi', 'Mashi');
                        addOption(combo2, 'Matazuu', 'Matazuu');
                        addOption(combo2, 'Musawa', 'Musawa');
                        addOption(combo2, 'Rimi', 'Rimi');
                        addOption(combo2, 'Sabuwa', 'Sabuwa');
                        addOption(combo2, 'Safana', 'Safana');
                        addOption(combo2, 'Sandamu', 'Sandamu');
                        addOption(combo2,  'Zango', 'Zango');
                        break;
        case 'Kebbi':  addOption(combo2, 'Aleiro', 'Aleiro');
                        addOption(combo2, 'Arewa-Dandi', 'Arewa-Dandi');
                        addOption(combo2, 'Argungu', 'Argungu');
                        addOption(combo2, 'Augie', 'Augie');
                        addOption(combo2, 'Bagudo', 'Bagudo');
                        addOption(combo2, 'Birnin Kebbi', 'Birnin Kebbi');
                        addOption(combo2, 'Bunza', 'Bunza');
                        addOption(combo2, 'Dandi', 'Dandi');
                        addOption(combo2, 'Fakai', 'Fakai');
                        addOption(combo2, 'Gwandu', 'Gwandu');
                        addOption(combo2, 'Jega', 'Jega');
                        addOption(combo2, 'Kalgo', 'Kalgo');
                        addOption(combo2, 'Koko/Besse', 'Koko/Besse');
                        addOption(combo2, 'Maiyama', 'Maiyama');
                        addOption(combo2, 'Ngaski', 'Ngaski');
                        addOption(combo2, 'Sakaba', 'Sakaba');
                        addOption(combo2,  'Shanga', 'Shanga');
                        addOption(combo2, 'Suru', 'Suru');
                        addOption(combo2, 'Wasagu/Danko', 'Wasagu/Danko');
                        addOption(combo2, 'Yauri', 'Yauri');
                        addOption(combo2,  'Zuru', 'Zuru');
                        break;
        case 'Kogi':  addOption(combo2, 'Adavi', 'Adavi');
                        addOption(combo2, 'Ajaokuta', 'Ajaokuta');
                        addOption(combo2, 'Ankpa', 'Ankpa');
                        addOption(combo2, 'Bassa', 'Bassa');
                        addOption(combo2, 'Dekina', 'Dekina');
                        addOption(combo2, 'Ibaji', 'Ibaji');
                        addOption(combo2, 'Idah', 'Idah');
                        addOption(combo2, 'Igalamela-Odolu', 'Igalamela-Odolu');
                        addOption(combo2,  'Ijumu', 'Ijumu');
                        addOption(combo2, 'Kabba/Bunu', 'Kabba/Bunu');
                        addOption(combo2, 'Kogi', 'Kogi');
                        addOption(combo2, 'Lokoja', 'Lokoja');
                        addOption(combo2, 'Mopa-Muro', 'Mopa-Muro');
                        addOption(combo2, 'Ofu', 'Ofu');
                        addOption(combo2,  'Ogori/Mangongo', 'Ogori/Mangongo');
                        addOption(combo2, 'Okehi', 'Okehi');
                        addOption(combo2, 'Okene', 'Okene');
                        addOption(combo2,  'Olamabolo', 'Olamabolo');
                        addOption(combo2, 'Omala', 'Omala');
                        addOption(combo2, 'Yagba East', 'Yagba East');
                        addOption(combo2, 'Yagba West', 'Yagba West');
                        break;
        case 'Kwara':  addOption(combo2, 'Asa', 'Asa');
                        addOption(combo2, 'Baruten', 'Baruten');
                        addOption(combo2,  'Edu', 'Edu');
                        addOption(combo2, 'Ekiti', 'Ekiti');
                        addOption(combo2, 'Ifelodun', 'Ifelodun');
                        addOption(combo2, 'Ilorin East', 'Ilorin East');
                        addOption(combo2, 'Ilorin West', 'Ilorin West');
                        addOption(combo2, 'Irepodun', 'Irepodun');
                        addOption(combo2, 'Isin', 'Isin');
                        addOption(combo2, 'Kaiama', 'Kaiama');
                        addOption(combo2, 'Moro', 'Moro');
                        addOption(combo2,  'Offa', 'Offa');
                        addOption(combo2, 'Oke-Ero', 'Oke-Ero');
                        addOption(combo2, 'Oyun', 'Oyun');
                        addOption(combo2,  'Pategi', 'Pategi');
                        break;
        case 'Lagos':  addOption(combo2, 'Agege', 'Agege');
                        addOption(combo2,  'Ajeromi-Ifelodun', 'Ajeromi-Ifelodun');
                        addOption(combo2,  'Alimosho', 'Alimosho');
                        addOption(combo2,  'Amuwo-Odofin', 'Amuwo-Odofin');
                        addOption(combo2, 'Apapa', 'Apapa');
                        addOption(combo2, 'Badagry', 'Badagry');
                        addOption(combo2, 'Epe', 'Epe');
                        addOption(combo2, 'Eti-Osa', 'Eti-Osa');
                        addOption(combo2, 'Ibeju/Lekki', 'Ibeju/Lekki');
                        addOption(combo2, 'Ifako-Ijaye', 'Ifako-Ijaye');
                        addOption(combo2,  'Ikeja', 'Ikeja');
                        addOption(combo2,  'Ikorodu', 'Ikorodu');
                        addOption(combo2,  'Kosofe', 'Kosofe');
                        addOption(combo2, 'Lagos Island', 'Lagos Island');
                        addOption(combo2,  'Lagos Mainland', 'Lagos Mainland');
                        addOption(combo2,  'Mushin', 'Mushin');
                        addOption(combo2,  'Ojo', 'Ojo');
                        addOption(combo2, 'Oshodi-Isolo', 'Oshodi-Isolo');
                        addOption(combo2, 'Shomolu', 'Shomolu');
                        addOption(combo2, 'Surulere', 'Surulere');
                        break;
        case 'Nassarawa':  addOption(combo2, 'Akwanga', 'Akwanga');
                        addOption(combo2,  'Awe', 'Awe');
                        addOption(combo2, 'Doma', 'Doma');
                        addOption(combo2, 'Karu', 'Karu');
                        addOption(combo2, 'Keana', 'Keana');
                        addOption(combo2, 'Keffi', 'Keffi');
                        addOption(combo2, 'Kokona', 'Kokona');
                        addOption(combo2, 'Lafia', 'Lafia');
                        addOption(combo2, 'Nasarawa', 'Nasarawa');
                        addOption(combo2, 'Nasarawa-Eggon', 'Nasarawa-Eggon');
                        addOption(combo2, 'Obi', 'Obi');
                        addOption(combo2, 'Toto', 'Toto');
                        addOption(combo2,  'Wamba', 'Wamba');
                        break;
        case 'Niger':  addOption(combo2, 'Agaie', 'Agaie');
                        addOption(combo2, 'Agwara', 'Agwara');
                        addOption(combo2,  'Bida', 'Bida');
                        addOption(combo2, 'Borgu', 'Borgu');
                        addOption(combo2,  'Bosso', 'Bosso');
                        addOption(combo2, 'Chanchaga', 'Chanchaga');
                        addOption(combo2,  'Edati', 'Edati');
                        addOption(combo2, 'Gbako', 'Gbako');
                        addOption(combo2, 'Gurara', 'Gurara');
                        addOption(combo2, 'Katcha', 'Katcha');
                        addOption(combo2, 'Kontagora', 'Kontagora');
                        addOption(combo2,  'Lapai', 'Lapai');
                        addOption(combo2,  'Lavun', 'Lavun');
                        addOption(combo2, 'Magama', 'Magama');
                        addOption(combo2, 'Mariga', 'Mariga');
                        addOption(combo2,  'Mashegu', 'Mashegu');
                        addOption(combo2, 'Mokwa', 'Mokwa');
                        addOption(combo2, 'Muya', 'Muya');
                        addOption(combo2, 'Pailoro', 'Pailoro');
                        addOption(combo2, 'Rafi', 'Rafi');
                        addOption(combo2,  'Rijau', 'Rijau');
                        addOption(combo2, 'Shiroro', 'Shiroro');
                        addOption(combo2, 'Suleja', 'Suleja');
                        addOption(combo2, 'Tafa', 'Tafa');
                        addOption(combo2, 'Wushishi', 'Wushishi');
                        break;
        case 'Ogun':  addOption(combo2, 'Abeokuta North', 'Abeokuta North');
                        addOption(combo2,  'Abeokuta South', 'Abeokuta South');
                        addOption(combo2, 'Ado-Odo/Ota', 'Ado-Odo/Ota');
                        addOption(combo2, 'Egbado North', 'Egbado North');
                        addOption(combo2,  'Egbado South', 'Egbado South');
                        addOption(combo2, 'Ewekoro', 'Ewekoro');
                        addOption(combo2, 'Ifo', 'Ifo');
                        addOption(combo2, 'Ijebu East', 'Ijebu East');
                        addOption(combo2, 'Ijebu North', 'Ijebu North');
                        addOption(combo2,  'Ijebu North East', 'Ijebu North East');
                        addOption(combo2, 'Ijebu Ode', 'Ijebu Ode');
                        addOption(combo2,'Ikenne', 'Ikenne');
                        addOption(combo2,  'Imeko-Afon', 'Imeko-Afon');
                        addOption(combo2,  'Ipokia', 'Ipokia');
                        addOption(combo2,  'Obafemi-Owode', 'Obafemi-Owode');
                        addOption(combo2, 'Ogun Waterside', 'Ogun Waterside');
                        addOption(combo2, 'Odeda', 'Odeda');
                        addOption(combo2, 'Odogbolu', 'Odogbolu');
                        addOption(combo2, 'Remo North', 'Remo North');
                        addOption(combo2, 'Shagamu', 'Shagamu');
                        break;
        case 'Ondo':  addOption(combo2, 'Akoko North East', 'Akoko North East');
                        addOption(combo2, 'Akoko North West', 'Akoko North West');
                        addOption(combo2,  'Akoko South Akure East', 'Akoko South Akure East');
                        addOption(combo2, 'Akoko South West', 'Akoko South West');
                        addOption(combo2, 'Akure North', 'Akure North');
                        addOption(combo2, 'Akure South', 'Akure South');
                        addOption(combo2, 'Ese-Odo', 'Ese-Odo');
                        addOption(combo2,  'Idanre', 'Idanre');
                        addOption(combo2, 'Ifedore', 'Ifedore');
                        addOption(combo2, 'Ilaje', 'Ilaje');
                        addOption(combo2, 'Ile-Oluji', 'Ile-Oluji');
                        addOption(combo2, 'Okeigbo', 'Okeigbo');
                        addOption(combo2,  'Irele', 'Irele');
                        addOption(combo2, 'Odigbo', 'Odigbo');
                        addOption(combo2, 'Okitipupa', 'Okitipupa');
                        addOption(combo2, 'Ondo East', 'Ondo East');
                        addOption(combo2, 'Ondo West', 'Ondo West');
                        addOption(combo2, 'Ose', 'Ose');
                        addOption(combo2, 'Owo', 'Owo');
                        break;
        case 'Osun':  addOption(combo2, 'Aiyedade', 'Aiyedade');
                        addOption(combo2, 'Aiyedire', 'Aiyedire');
                        addOption(combo2, 'Atakumosa East', 'Atakumosa East');
                        addOption(combo2, 'Atakumosa West', 'Atakumosa West');
                        addOption(combo2, 'Boluwaduro', 'Boluwaduro');
                        addOption(combo2,  'Boripe', 'Boripe');
                        addOption(combo2, 'Ede North', 'Ede North');
                        addOption(combo2,  'Ede South', 'Ede South');
                        addOption(combo2,  'Egbedore', 'Egbedore');
                        addOption(combo2, 'Ejigbo', 'Ejigbo');
                        addOption(combo2, 'Ife Central', 'Ife Central');
                        addOption(combo2, 'Ife East', 'Ife East');
                        addOption(combo2, 'Ife North', 'Ife North');
                        addOption(combo2, 'Ife South', 'Ife South');
                        addOption(combo2,  'Ifedayo', 'Ifedayo');
                        addOption(combo2, 'Ifelodun', 'Ifelodun');
                        addOption(combo2, 'Ila', 'Ila');
                        addOption(combo2, 'Ilesha East', 'Ilesha East');
                        addOption(combo2, 'Ilesha West', 'Ilesha West');
                        addOption(combo2, 'Irepodun', 'Irepodun');
                        addOption(combo2, 'Irewole', 'Irewole');
                        addOption(combo2, 'Isokan', 'Isokan');
                        addOption(combo2, 'Iwo', 'Iwo');
                        addOption(combo2, 'Obokun', 'Obokun');
                        addOption(combo2, 'Odo-Otin', 'Odo-Otin');
                        addOption(combo2, 'Ola-Oluwa', 'Ola-Oluwa');
                        addOption(combo2, 'Olorunda', 'Olorunda');
                        addOption(combo2, 'Oriade', 'Oriade');
                        addOption(combo2,  'Orolu', 'Orolu');
                        addOption(combo2,  'Osogbo', 'Osogbo');
                        break;
        case 'Oyo':  addOption(combo2, 'Afijio', 'Afijio');
                        addOption(combo2, 'Akinyele', 'Akinyele');
                        addOption(combo2, 'Atiba', 'Atiba');
                        addOption(combo2, 'Atigbo', 'Atigbo');
                        addOption(combo2, 'Egbeda', 'Egbeda');
                        addOption(combo2, 'IbadanCentral', 'IbadanCentral');
                        addOption(combo2, 'Ibadan North', 'Ibadan North');
                        addOption(combo2, 'Ibadan North West', 'Ibadan North West');
                        addOption(combo2, 'Ibadan South East', 'Ibadan South East');
                        addOption(combo2, 'Ibadan South West', 'Ibadan South West');
                        addOption(combo2, 'Ibarapa Central', 'Ibarapa Central');
                        addOption(combo2, 'Ibarapa East', 'Ibarapa East');
                        addOption(combo2, 'Ibarapa North', 'Ibarapa North');
                        addOption(combo2,  'Ido', 'Ido');
                        addOption(combo2,  'Irepo', 'Irepo');
                        addOption(combo2, 'Iseyin', 'Iseyin');
                        addOption(combo2, 'Itesiwaju', 'Itesiwaju');
                        addOption(combo2,  'Iwajowa', 'Iwajowa');
                        addOption(combo2,  'Kajola', 'Kajola');
                        addOption(combo2, 'Lagelu Ogbomosho North', 'Lagelu Ogbomosho North');
                        addOption(combo2, 'Ogbmosho South', 'Ogbmosho South');
                        addOption(combo2, 'Ogo Oluwa', 'Ogo Oluwa');
                        addOption(combo2, 'Olorunsogo', 'Olorunsogo');
                        addOption(combo2, 'Oluyole', 'Oluyole');
                        addOption(combo2,  'Ona-Ara', 'Ona-Ara');
                        addOption(combo2,  'Orelope', 'Orelope');
                        addOption(combo2, 'Ori Ire', 'Ori Ire');
                        addOption(combo2,  'Oyo East', 'Oyo East');
                        addOption(combo2,  'Oyo West', 'Oyo West');
                        addOption(combo2, 'Saki East', 'Saki East');
                        addOption(combo2, 'Saki West', 'Saki West');
                        addOption(combo2, 'Surulere', 'Surulere');
                        break;
        case 'Plateau':  addOption(combo2, 'Barikin Ladi', 'Barikin Ladi');
                        addOption(combo2, 'Bassa', 'Bassa');
                        addOption(combo2,  'Bokkos', 'Bokkos');
                        addOption(combo2, 'Jos East', 'Jos East');
                        addOption(combo2,  'Jos North', 'Jos North');
                        addOption(combo2, 'Jos South', 'Jos South');
                        addOption(combo2, 'Kanam', 'Kanam');
                        addOption(combo2, 'Kanke', 'Kanke');
                        addOption(combo2, 'Langtang North', 'Langtang North');
                        addOption(combo2,  'Langtang South', 'Langtang South');
                        addOption(combo2,  'Mangu', 'Mangu');
                        addOption(combo2, 'Mikang', 'Mikang');
                        addOption(combo2, 'Pankshin', 'Pankshin');
                        addOption(combo2, "Qua/'an Pan", "Qua/'an Pan");
                        addOption(combo2,  'Riyom', 'Riyom');
                        addOption(combo2, 'Shendam', 'Shendam');
                        addOption(combo2, 'Wase', 'Wase');
                        break;
        case 'Rivers':  addOption(combo2, 'Abua/Odual', 'Abua/Odual');
                        addOption(combo2, 'Ahoada East', 'Ahoada East');
                        addOption(combo2, 'Ahoada West', 'Ahoada West');
                        addOption(combo2, 'Akuku Toru', 'Akuku Toru');
                        addOption(combo2, 'Andoni', 'Andoni');
                        addOption(combo2, 'Asari-Toru', 'Asari-Toru');
                        addOption(combo2, 'Bonny', 'Bonny');
                        addOption(combo2, 'Degema', 'Degema');
                        addOption(combo2, 'Emohua', 'Emohua');
                        addOption(combo2, 'Eleme', 'Eleme');
                        addOption(combo2, 'Etche', 'Etche');
                        addOption(combo2, 'Gokana', 'Gokana');
                        addOption(combo2, 'Ikwerre', 'Ikwerre');
                        addOption(combo2, 'Khana', 'Khana');
                        addOption(combo2, 'Obia/Akpor', 'Obia/Akpor');
                        addOption(combo2, 'Ogba/Egbema/Ndoni', 'Ogba/Egbema/Ndoni');
                        addOption(combo2, 'Ogu/Bolo', 'Ogu/Bolo');
                        addOption(combo2, 'Okrika', 'Okrika');
                        addOption(combo2,  'Omumma', 'Omumma');
                        addOption(combo2, 'Opobo/Nkoro', 'Opobo/Nkoro');
                        addOption(combo2,  'Oyigbo', 'Oyigbo');
                        addOption(combo2, 'Port-Harcourt', 'Port-Harcourt');
                        addOption(combo2, 'Tai', 'Tai');
                        break;
                        
        case 'Sokoto':  addOption(combo2, 'Binji', 'Binji');
                        addOption(combo2, 'Bodinga', 'Bodinga');
                        addOption(combo2, 'Dange-shnsi', 'Dange-shnsi');
                        addOption(combo2, 'Gada', 'Gada');
                        addOption(combo2, 'Goronyo', 'Goronyo');
                        addOption(combo2, 'Gudu', 'Gudu');
                        addOption(combo2, 'Gawabawa', 'Gawabawa');
                        addOption(combo2,  'Illela', 'Illela');
                        addOption(combo2, 'Isa', 'Isa');
                        addOption(combo2, 'Kware', 'Kware');
                        addOption(combo2,  'kebbe', 'kebbe');
                        addOption(combo2, 'Rabah', 'Rabah');
                        addOption(combo2, 'Sabon birni', 'Sabon birni');
                        addOption(combo2, 'Shagari', 'Shagari');
                        addOption(combo2,  'Silame', 'Silame');
                        addOption(combo2, 'Sokoto North', 'Sokoto North');
                        addOption(combo2, 'Sokoto South', 'Sokoto South');
                        addOption(combo2, 'Tambuwal', 'Tambuwal');
                        addOption(combo2, 'Tqngaza', 'Tqngaza');
                        addOption(combo2, 'Tureta', 'Tureta');
                        addOption(combo2, 'Wamako', 'Wamako');
                        addOption(combo2, 'Wurno', 'Wurno');
                        addOption(combo2, 'Yabo', 'Yabo');
                        break;
        case 'Taraba':  addOption(combo2, 'Ardo-kola', 'Ardo-kola');
                        addOption(combo2, 'Bali', 'Bali');
                        addOption(combo2, 'Donga', 'Donga');
                        addOption(combo2, 'Gashaka', 'Gashaka');
                        addOption(combo2, 'Cassol', 'Cassol');
                        addOption(combo2, 'Ibi', 'Ibi');
                        addOption(combo2, 'Jalingo', 'Jalingo');
                        addOption(combo2, 'Karin-Lamido', 'Karin-Lamido');
                        addOption(combo2, 'Kurmi', 'Kurmi');
                        addOption(combo2,  'Lau', 'Lau');
                        addOption(combo2, 'Sardauna', 'Sardauna');
                        addOption(combo2, 'Takum', 'Takum');
                        addOption(combo2, 'Ussa', 'Ussa');
                        addOption(combo2, 'Wukari', 'Wukari');
                        addOption(combo2,  'Yorro', 'Yorro');
                        addOption(combo2, 'Zing', 'Zing');
                        break;
        case 'Yobe':  addOption(combo2, 'Bade', 'Bade');
                        addOption(combo2,  'Bursari', 'Bursari');
                        addOption(combo2, 'Damaturu', 'Damaturu');
                        addOption(combo2, 'Fika', 'Fika');
                        addOption(combo2, 'Fune', 'Fune');
                        addOption(combo2, 'Geidam', 'Geidam');
                        addOption(combo2, 'Gujba', 'Gujba');
                        addOption(combo2, 'Gulani', 'Gulani');
                        addOption(combo2,  'Jakusko', 'Jakusko');
                        addOption(combo2, 'Karasuwa', 'Karasuwa');
                        addOption(combo2, 'Karawa', 'Karawa');
                        addOption(combo2, 'Machina', 'Machina');
                        addOption(combo2, 'Nangere', 'Nangere');
                        addOption(combo2, 'Nguru Potiskum', 'Nguru Potiskum');
                        addOption(combo2, 'Tarmua', 'Tarmua');
                        addOption(combo2, 'Yunusari', 'Yunusari');
                        addOption(combo2, 'Yusufari', 'Yusufari');
                        break;
        case 'Zamfara':  addOption(combo2, 'Anka', 'Anka');
                        addOption(combo2, 'Bakura', 'Bakura');
                        addOption(combo2, 'Birnin Magaji', 'Birnin Magaji');
                        addOption(combo2, 'Bukkuyum', 'Bukkuyum');
                        addOption(combo2, 'Bungudu', 'Bungudu');
                        addOption(combo2, 'Gummi', 'Gummi');
                        addOption(combo2, 'Gusau', 'Gusau');
                        addOption(combo2,  'Kaura', 'Kaura');
                        addOption(combo2, 'Namoda', 'Namoda');
                        addOption(combo2, 'Maradun', 'Maradun');
                        addOption(combo2,  'Maru', 'Maru');
                        addOption(combo2, 'Shinkafi', 'Shinkafi');
                        addOption(combo2,  'Talata Mafara', 'Talata Mafara');
                        addOption(combo2, 'Tsafe', 'Tsafe');
                        addOption(combo2, 'Zurmi', 'Zurmi');
                        break;
            }
    }
    function emptyCombo(e)
    {
        e.innerHTML = '';
    }
 
    function addOption(combo, val, txt)
    {
        var option = document.createElement('option');
        option.value = val;
        option.title = txt;
        option.appendChild(document.createTextNode(txt));
        combo.appendChild(option);
    }




function noNumbers(e, t) 
{
            try {

                if (window.event) {

                    var charCode = window.event.keyCode;

                }

                else if (e) {

                    var charCode = e.which;

                }

                else { return true; }

                if (charCode > 31 && (charCode < 48 || charCode > 57)) {

                    return false;

                }

                return true;

            }

            catch (err) {

                alert(err.Description);

            }

         
}
 
function GetXmlHttpObject()
{
	var xmlHttp=null;
	try
		{
			 // Firefox, Opera 8.0+, Safari
			xmlHttp=new XMLHttpRequest();
		}
	catch (e)
		{
			// Internet Explorer
			 try
				{
					xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
				}
			  catch (e)
				{
					xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
		}
			return xmlHttp;
}


function stateChanged33() 
{ 
	if (xmlHttp.readyState==4)
	{ 
		//document.getElementById('show_cart').innerHTML="";
		//document.getElementById('show_cart').innerHTML=xmlHttp.responseText;
		var outcome = xmlHttp.responseText;
		if(outcome!="No records"){
			var scat = outcome.split(";");
			//var t = scat[1];
				  
			byId('c_name').value = scat[0];
			byId('c_no').value = scat[1];
			byId('c_email').value = scat[2];
			byId('cmbstate').value = scat[3];
			byId('cmblgov').value = scat[4];
			byId('c_address').value = scat[5];
			byId('c_paddress').value = scat[6];
		}else{
		
			byId('c_name').value = "";
			byId('c_no').value = "";
			byId('c_email').value = "";
			byId('cmbstate').value = "";
			byId('cmblgov').value = "";
			byId('c_address').value = "";
			byId('c_paddress').value = "";
		
		}
	}
}
function retrieve_details(){
	var good_id =prompt("Please Enter the Id Of Your former Transaction","");
	if (good_id!=null && good_id!="")
	  {
		
		//x="Hello " + good_id + "! How are you today?";
		//alert(x);
		
		xmlHttp=GetXmlHttpObject();
			if (xmlHttp==null)
			  {
			  alert ("Your browser does not support AJAX!");
			  return;
			 }
			
			
			var submit2 = "retrieve_detail";
			var url="Cart_Processor.php";
			parameters="retrieve_details="+submit2+"&goods_id="+good_id;
			xmlHttp.onreadystatechange=stateChanged33;
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
			xmlHttp.send(parameters);
	  }

} 