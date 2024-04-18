document.addEventListener("DOMContentLoaded", function() {
    const address = {
        'municipalities': [
            'Aloran',
            'Baliangao',
            'Bonifacio',
            'Calamba',
            'Clarin',
            'Concepcion',
            'Don Victoriano Chiongbian',
            'Jimenez',
            'Lopez Jaena',
            'Oroquieta City',
            'Ozamiz City',
            'Panaon',
            'Plaridel',
            'Sapang Dalaga',
            'Sinacaban',
            'Tangub City',
            'Tudela'
        ],
        'barangays': [
            { 'municipality': 'Tangub City', 'barangay': 'Silanga' },
            { 'municipality': 'Tangub City', 'barangay': 'Aquino (Marcos)' },
            { 'municipality': 'Tangub City', 'barangay': 'Santa Maria (Baga)' },
            { 'municipality': 'Tangub City', 'barangay': 'Balatacan' },
            { 'municipality': 'Tangub City', 'barangay': 'Baluk' },
            { 'municipality': 'Tangub City', 'barangay': 'Banglay' },
            { 'municipality': 'Tangub City', 'barangay': 'Mantic' },
            { 'municipality': 'Tangub City', 'barangay': 'Mingcanaway' },
            { 'municipality': 'Tangub City', 'barangay': 'Bintana' },
            { 'municipality': 'Tangub City', 'barangay': 'Bocator' },
            { 'municipality': 'Tangub City', 'barangay': 'Bongabong' },
            { 'municipality': 'Tangub City', 'barangay': 'Caniangan' },
            { 'municipality': 'Tangub City', 'barangay': 'Capalaran' },
            { 'municipality': 'Tangub City', 'barangay': 'Catagan' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay I - City Hall (Poblacion)' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay II - Marilou Annex (Poblacion)' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay IV - St. Michael (Poblacion)' },
            { 'municipality': 'Tangub City', 'barangay': 'Isidro D. Tan (Dimalooc)' },
            { 'municipality': 'Tangub City', 'barangay': 'Garang' },
            { 'municipality': 'Tangub City', 'barangay': 'Guinabot' },
            { 'municipality': 'Tangub City', 'barangay': 'Guinalaban' },
            { 'municipality': 'Tangub City', 'barangay': 'Hoyohoy' },
            { 'municipality': 'Tangub City', 'barangay': 'Kauswagan' },
            { 'municipality': 'Tangub City', 'barangay': 'Kimat' },
            { 'municipality': 'Tangub City', 'barangay': 'Labuyo' },
            { 'municipality': 'Tangub City', 'barangay': 'Lorenzo Tan' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay VI - Lower Polao (Poblacion)' },
            { 'municipality': 'Tangub City', 'barangay': 'Lumban' },
            { 'municipality': 'Tangub City', 'barangay': 'Maloro' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay V - Malubog (Poblacion)' },
            { 'municipality': 'Tangub City', 'barangay': 'Manga' },
            { 'municipality': 'Tangub City', 'barangay': 'Maquilao' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay III- Market Kalubian (Pob.' },
            { 'municipality': 'Tangub City', 'barangay': 'Matugnao' },
            { 'municipality': 'Tangub City', 'barangay': 'Minsubong' },
            { 'municipality': 'Tangub City', 'barangay': 'Owayan' },
            { 'municipality': 'Tangub City', 'barangay': 'Paiton' },
            { 'municipality': 'Tangub City', 'barangay': 'Panalsalan' },
            { 'municipality': 'Tangub City', 'barangay': 'Pangabuan' },
            { 'municipality': 'Tangub City', 'barangay': 'Prenza' },
            { 'municipality': 'Tangub City', 'barangay': 'Salimpuno' },
            { 'municipality': 'Tangub City', 'barangay': 'San Antonio' },
            { 'municipality': 'Tangub City', 'barangay': 'San Apolinario' },
            { 'municipality': 'Tangub City', 'barangay': 'San Vicente' },
            { 'municipality': 'Tangub City', 'barangay': 'Santa Cruz' },
            { 'municipality': 'Tangub City', 'barangay': 'Santo Niå˜o' },
            { 'municipality': 'Tangub City', 'barangay': 'Sicot' },
            { 'municipality': 'Tangub City', 'barangay': 'Silanga' },
            { 'municipality': 'Tangub City', 'barangay': 'Silangit' },
            { 'municipality': 'Tangub City', 'barangay': 'Simasay' },
            { 'municipality': 'Tangub City', 'barangay': 'Sumirap' },
            { 'municipality': 'Tangub City', 'barangay': 'Taguite' },
            { 'municipality': 'Tangub City', 'barangay': 'Tituron' },
            { 'municipality': 'Tangub City', 'barangay': 'Tugas' },
            { 'municipality': 'Tangub City', 'barangay': 'Barangay VII - Upper Polao (Poblacion)' },
            { 'municipality': 'Tangub City', 'barangay': 'Villaba' },
    
            { 'municipality': 'Aloran', 'barangay': 'Balintonga' },
            { 'municipality': 'Aloran', 'barangay': 'Banisilon' },
            { 'municipality': 'Aloran', 'barangay': 'Burgos' },
            { 'municipality': 'Aloran', 'barangay': 'Calube' },
            { 'municipality': 'Aloran', 'barangay': 'Caputol' },
            { 'municipality': 'Aloran', 'barangay': 'Casusan' },
            { 'municipality': 'Aloran', 'barangay': 'Conat' },
            { 'municipality': 'Aloran', 'barangay': 'Culpan' },
            { 'municipality': 'Aloran', 'barangay': 'Dalisay (Poblacion)' },
            { 'municipality': 'Aloran', 'barangay': 'Dullan' },
            { 'municipality': 'Aloran', 'barangay': 'Ibabao (Poblacion)' },
            { 'municipality': 'Aloran', 'barangay': 'Tubod' },
            { 'municipality': 'Aloran', 'barangay': 'Labo' },
            { 'municipality': 'Aloran', 'barangay': 'Lawa-an' },
            { 'municipality': 'Aloran', 'barangay': 'Lobogon' },
            { 'municipality': 'Aloran', 'barangay': 'Lumbayao' },
            { 'municipality': 'Aloran', 'barangay': 'Makawa' },
            { 'municipality': 'Aloran', 'barangay': 'Manamong' },
            { 'municipality': 'Aloran', 'barangay': 'Matipaz' },
            { 'municipality': 'Aloran', 'barangay': 'Maular' },
            { 'municipality': 'Aloran', 'barangay': 'Mitazan' },
            { 'municipality': 'Aloran', 'barangay': 'Mohon' },
            { 'municipality': 'Aloran', 'barangay': 'Monterico' },
            { 'municipality': 'Aloran', 'barangay': 'Nabuna' },
            { 'municipality': 'Aloran', 'barangay': 'Palayan' },
            { 'municipality': 'Aloran', 'barangay': 'Pelong' },
            { 'municipality': 'Aloran', 'barangay': 'Ospital (poblacion)' },
            { 'municipality': 'Aloran', 'barangay': 'Roxas' },
            { 'municipality': 'Aloran', 'barangay': 'San Pedro' },
            { 'municipality': 'Aloran', 'barangay': 'Santa Ana' },
            { 'municipality': 'Aloran', 'barangay': 'Sinampongan' },
            { 'municipality': 'Aloran', 'barangay': 'Taguanao' },
            { 'municipality': 'Aloran', 'barangay': 'Tawi-tawi' },
            { 'municipality': 'Aloran', 'barangay': 'Toril' },
            { 'municipality': 'Aloran', 'barangay': 'Tuburan' },
            { 'municipality': 'Aloran', 'barangay': 'Zamora' },
            { 'municipality': 'Aloran', 'barangay': 'Macubon (Sina-ad)' },
            { 'municipality': 'Aloran', 'barangay': 'Tugaya' },
    
            { 'municipality': 'Baliangao', 'barangay': 'Del Pilar' },
            { 'municipality': 'Baliangao', 'barangay': 'Landing' },
            { 'municipality': 'Baliangao', 'barangay': 'Lumipac' },
            { 'municipality': 'Baliangao', 'barangay': 'Lusot' },
            { 'municipality': 'Baliangao', 'barangay': 'Mabini' },
            { 'municipality': 'Baliangao', 'barangay': 'Magsaysay' },
            { 'municipality': 'Baliangao', 'barangay': 'Misom' },
            { 'municipality': 'Baliangao', 'barangay': 'Mitacas' },
            { 'municipality': 'Baliangao', 'barangay': 'Naburos' },
            { 'municipality': 'Baliangao', 'barangay': 'Northern Poblacion' },
            { 'municipality': 'Baliangao', 'barangay': 'Punta Miray' },
            { 'municipality': 'Baliangao', 'barangay': 'Punta Sulong' },
            { 'municipality': 'Baliangao', 'barangay': 'Sinian' },
            { 'municipality': 'Baliangao', 'barangay': 'Southern Poblacion' },
            { 'municipality': 'Baliangao', 'barangay': 'Tugas' },
    
            { 'municipality': 'Bonifacio', 'barangay': 'Bag-ong Anonang' },
            { 'municipality': 'Bonifacio', 'barangay': 'Bagumbang' },
            { 'municipality': 'Bonifacio', 'barangay': 'Baybay' },
            { 'municipality': 'Bonifacio', 'barangay': 'Bolinsong' },
            { 'municipality': 'Bonifacio', 'barangay': 'Buenavista' },
            { 'municipality': 'Bonifacio', 'barangay': 'Buracan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Calolot' },
            { 'municipality': 'Bonifacio', 'barangay': 'Dimalco' },
            { 'municipality': 'Bonifacio', 'barangay': 'Dullan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Kanaokanao' },
            { 'municipality': 'Bonifacio', 'barangay': 'Liloan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Linconan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Lodiong' },
            { 'municipality': 'Bonifacio', 'barangay': 'Lower Usugan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Mapurog (Migsale)' },
            { 'municipality': 'Bonifacio', 'barangay': 'Migpange' },
            { 'municipality': 'Bonifacio', 'barangay': 'Montol' },
            { 'municipality': 'Bonifacio', 'barangay': 'Pisa-an' },
            { 'municipality': 'Bonifacio', 'barangay': 'Poblacion' },
            { 'municipality': 'Bonifacio', 'barangay': 'Remedios' },
            { 'municipality': 'Bonifacio', 'barangay': 'Rufino Lumapas' },
            { 'municipality': 'Bonifacio', 'barangay': 'Sibuyon' },
            { 'municipality': 'Bonifacio', 'barangay': 'Tangab' },
            { 'municipality': 'Bonifacio', 'barangay': 'Tiaman' },
            { 'municipality': 'Bonifacio', 'barangay': 'Tusik' },
            { 'municipality': 'Bonifacio', 'barangay': 'Upper Usogan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Demetrio Fernan' },
            { 'municipality': 'Bonifacio', 'barangay': 'Digson' },
    
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Bagong Clarin' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Gandawan' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Lake Duminagat' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Lalud' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Lampasan' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Liboron' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Maramara' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Napangan' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Nueva Vista (Masawan)' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Petianan' },
            { 'municipality': 'Don Victoriano Chiongbian', 'barangay': 'Tuno' },
    
            { 'municipality': 'Tudela', 'barangay': 'Balon' },
            { 'municipality': 'Tudela', 'barangay': 'Barra' },
            { 'municipality': 'Tudela', 'barangay': 'Basirang' },
            { 'municipality': 'Tudela', 'barangay': 'Bongabong' },
            { 'municipality': 'Tudela', 'barangay': 'Buenavista' },
            { 'municipality': 'Tudela', 'barangay': 'Cabol-anonan' },
            { 'municipality': 'Tudela', 'barangay': 'Cahayag' },
            { 'municipality': 'Tudela', 'barangay': 'Camating' },
            { 'municipality': 'Tudela', 'barangay': 'Canibungan Proper' },
            { 'municipality': 'Tudela', 'barangay': 'Casilak San Agustin' },
            { 'municipality': 'Tudela', 'barangay': 'Centro Hulpa (Poblacion)' },
            { 'municipality': 'Tudela', 'barangay': 'Centro Napu (Poblacion)' },
            { 'municipality': 'Tudela', 'barangay': 'Centro Upper (Poblacion)' },
            { 'municipality': 'Tudela', 'barangay': 'Colambutan Bajo' },
            { 'municipality': 'Tudela', 'barangay': 'Calambutan Settlement' },
            { 'municipality': 'Tudela', 'barangay': 'Duanguican' },
            { 'municipality': 'Tudela', 'barangay': 'Gala' },
            { 'municipality': 'Tudela', 'barangay': 'Gumbil' },
            { 'municipality': 'Tudela', 'barangay': 'Locso-on' },
            { 'municipality': 'Tudela', 'barangay': 'Maikay' },
            { 'municipality': 'Tudela', 'barangay': 'Maribojoc' },
            { 'municipality': 'Tudela', 'barangay': 'Mitugas' },
            { 'municipality': 'Tudela', 'barangay': 'Nailon' },
            { 'municipality': 'Tudela', 'barangay': 'Namut' },
            { 'municipality': 'Tudela', 'barangay': 'Napurog' },
            { 'municipality': 'Tudela', 'barangay': 'Pan-ay Diot' },
            { 'municipality': 'Tudela', 'barangay': 'San Nicolas' },
            { 'municipality': 'Tudela', 'barangay': 'Sebac' },
    
            { 'municipality': 'Sinacaban', 'barangay': 'Bliss Project' },
            { 'municipality': 'Sinacaban', 'barangay': 'Cagay-anon' },
            { 'municipality': 'Sinacaban', 'barangay': 'Camanse' },
            { 'municipality': 'Sinacaban', 'barangay': 'Colupan Alto' },
            { 'municipality': 'Sinacaban', 'barangay': 'Colupan Bajo' },
            { 'municipality': 'Sinacaban', 'barangay': 'Dinas' },
            { 'municipality': 'Sinacaban', 'barangay': 'Estrella' },
            { 'municipality': 'Sinacaban', 'barangay': 'Katipunan' },
            { 'municipality': 'Sinacaban', 'barangay': 'Libertad Alto' },
            { 'municipality': 'Sinacaban', 'barangay': 'Libertad Bajo' },
            { 'municipality': 'Sinacaban', 'barangay': 'Poblacion' },
            { 'municipality': 'Sinacaban', 'barangay': 'San Isidro Alto' },
            { 'municipality': 'Sinacaban', 'barangay': 'San Isidro Bajo' },
            { 'municipality': 'Sinacaban', 'barangay': 'San Vicente' },
            { 'municipality': 'Sinacaban', 'barangay': 'Seå˜or' },
            { 'municipality': 'Sinacaban', 'barangay': 'Sinonoc' },
            { 'municipality': 'Sinacaban', 'barangay': 'San Lorenzo Ruiz (Sungan)' },
            { 'municipality': 'Sinacaban', 'barangay': 'Tipan' },
    
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Bautista' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Bitibut' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Boundary' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Caluya' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Capundag' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Casul' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Dalumpinas' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Dasa' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Dioyo' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Disoy' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'El Paraiso' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Guinabot' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Libertad' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Locus' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Macabibo' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Manla' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Masubong' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Medallo' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Agapito Yap Sr. (Napilan)' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Poblacion' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Salimpuno' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'San Agustin' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Sapang Ama' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Sinaad' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Sipac' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Sixto Velez Sr.' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Upper Bautista' },
            { 'municipality': 'Sapang Dalaga', 'barangay': 'Ventura' },
    
            { 'municipality': 'Plaridel', 'barangay': 'Agunod' },
            { 'municipality': 'Plaridel', 'barangay': 'Bato' },
            { 'municipality': 'Plaridel', 'barangay': 'Buena Voluntad' },
            { 'municipality': 'Plaridel', 'barangay': 'Calaca-an' },
            { 'municipality': 'Plaridel', 'barangay': 'Cartagena Proper' },
            { 'municipality': 'Plaridel', 'barangay': 'Catarman' },
            { 'municipality': 'Plaridel', 'barangay': 'Cebulin' },
            { 'municipality': 'Plaridel', 'barangay': 'Clarin' },
            { 'municipality': 'Plaridel', 'barangay': 'Danao' },
            { 'municipality': 'Plaridel', 'barangay': 'Deboloc' },
            { 'municipality': 'Plaridel', 'barangay': 'Divisoria' },
            { 'municipality': 'Plaridel', 'barangay': 'Eastern Looc' },
            { 'municipality': 'Plaridel', 'barangay': 'Ilisan' },
            { 'municipality': 'Plaridel', 'barangay': 'Katipunan' },
            { 'municipality': 'Plaridel', 'barangay': 'Kauswagan' },
            { 'municipality': 'Plaridel', 'barangay': 'Lao Proper' },
            { 'municipality': 'Plaridel', 'barangay': 'Lao Santa Cruz' },
            { 'municipality': 'Plaridel', 'barangay': 'Looc Proper' },
            { 'municipality': 'Plaridel', 'barangay': 'Mamanga Daku' },
            { 'municipality': 'Plaridel', 'barangay': 'Mamanga Gamay' },
            { 'municipality': 'Plaridel', 'barangay': 'Mangidkid' },
            { 'municipality': 'Plaridel', 'barangay': 'New Cartagena' },
            { 'municipality': 'Plaridel', 'barangay': 'New Look' },
            { 'municipality': 'Plaridel', 'barangay': 'Northern Poblacion' },
            { 'municipality': 'Plaridel', 'barangay': 'Panalsalan' },
            { 'municipality': 'Plaridel', 'barangay': 'Puntod' },
            { 'municipality': 'Plaridel', 'barangay': 'Quirino' },
            { 'municipality': 'Plaridel', 'barangay': 'Santa Cruz' },
            { 'municipality': 'Plaridel', 'barangay': 'Southern Looc' },
            { 'municipality': 'Plaridel', 'barangay': 'Southern Poblacion' },
            { 'municipality': 'Plaridel', 'barangay': 'Tipolo' },
            { 'municipality': 'Plaridel', 'barangay': 'Unidos' },
            { 'municipality': 'Plaridel', 'barangay': 'Usocan' },
    
            { 'municipality': 'Panaon', 'barangay': 'Baga' },
            { 'municipality': 'Panaon', 'barangay': 'Bangko' },
            { 'municipality': 'Panaon', 'barangay': 'Camanucan' },
            { 'municipality': 'Panaon', 'barangay': 'Dela Paz' },
            { 'municipality': 'Panaon', 'barangay': 'Lutao' },
            { 'municipality': 'Panaon', 'barangay': 'Magsaysay' },
            { 'municipality': 'Panaon', 'barangay': 'Map-an' },
            { 'municipality': 'Panaon', 'barangay': 'Mohon' },
            { 'municipality': 'Panaon', 'barangay': 'Poblacion' },
            { 'municipality': 'Panaon', 'barangay': 'Punta' },
            { 'municipality': 'Panaon', 'barangay': 'Salimpuno' },
            { 'municipality': 'Panaon', 'barangay': 'San Andres' },
            { 'municipality': 'Panaon', 'barangay': 'San Juan' },
            { 'municipality': 'Panaon', 'barangay': 'San Roque' },
            { 'municipality': 'Panaon', 'barangay': 'Sumasap' },
            { 'municipality': 'Panaon', 'barangay': 'Villalin' },
    
            { 'municipality': 'Calamba', 'barangay': 'Bonifacio' },
            { 'municipality': 'Calamba', 'barangay': 'Bunawan' },
            { 'municipality': 'Calamba', 'barangay': 'Calaran' },
            { 'municipality': 'Calamba', 'barangay': 'Dapacan Alto' },
            { 'municipality': 'Calamba', 'barangay': 'Dapacan Bajo' },
            { 'municipality': 'Calamba', 'barangay': 'Langub' },
            { 'municipality': 'Calamba', 'barangay': 'Libertad' },
            { 'municipality': 'Calamba', 'barangay': 'Magcamiguing' },
            { 'municipality': 'Calamba', 'barangay': 'Mamalad' },
            { 'municipality': 'Calamba', 'barangay': 'Mauswagon' },
            { 'municipality': 'Calamba', 'barangay': 'Northern Poblacion' },
            { 'municipality': 'Calamba', 'barangay': 'Salvador' },
            { 'municipality': 'Calamba', 'barangay': 'San Isidro' },
            { 'municipality': 'Calamba', 'barangay': 'Siloy' },
            { 'municipality': 'Calamba', 'barangay': 'Singalat' },
            { 'municipality': 'Calamba', 'barangay': 'Solinog' },
            { 'municipality': 'Calamba', 'barangay': 'Southwestern Poblacion' },
            { 'municipality': 'Calamba', 'barangay': 'Sulipat' },
            { 'municipality': 'Calamba', 'barangay': 'Don Bernardo Neri Poblacion' },
    
            { 'municipality': 'Clarin', 'barangay': 'Bernad' },
            { 'municipality': 'Clarin', 'barangay': 'Bito-on' },
            { 'municipality': 'Clarin', 'barangay': 'Cabunga-an' },
            { 'municipality': 'Clarin', 'barangay': 'Canibungan Daku' },
            { 'municipality': 'Clarin', 'barangay': 'Canibungan Putol' },
            { 'municipality': 'Clarin', 'barangay': 'Canipacan' },
            { 'municipality': 'Clarin', 'barangay': 'Dalingap' },
            { 'municipality': 'Clarin', 'barangay': 'Dela Paz' },
            { 'municipality': 'Clarin', 'barangay': 'Dolores' },
            { 'municipality': 'Clarin', 'barangay': 'Gata Daku' },
            { 'municipality': 'Clarin', 'barangay': 'Gata Diot' },
            { 'municipality': 'Clarin', 'barangay': 'Guba (Ozamis)' },
            { 'municipality': 'Clarin', 'barangay': 'Kinangay Norte' },
            { 'municipality': 'Clarin', 'barangay': 'Kinangay Sur' },
            { 'municipality': 'Clarin', 'barangay': 'Lapasan' },
            { 'municipality': 'Clarin', 'barangay': 'Lupagan' },
            { 'municipality': 'Clarin', 'barangay': 'Malibangcao' },
            { 'municipality': 'Clarin', 'barangay': 'Masabud' },
            { 'municipality': 'Clarin', 'barangay': 'Mialen' },
            { 'municipality': 'Clarin', 'barangay': 'Pan-ay' },
            { 'municipality': 'Clarin', 'barangay': 'Penacio' },
            { 'municipality': 'Clarin', 'barangay': 'Poblacion I' },
            { 'municipality': 'Clarin', 'barangay': 'Poblacion II' },
            { 'municipality': 'Clarin', 'barangay': 'Poblacion III' },
            { 'municipality': 'Clarin', 'barangay': 'Poblacion IV' },
            { 'municipality': 'Clarin', 'barangay': 'Segatic Daku' },
            { 'municipality': 'Clarin', 'barangay': 'Segatic Diot' },
            { 'municipality': 'Clarin', 'barangay': 'Sebasi' },
            { 'municipality': 'Clarin', 'barangay': 'Tinacla-an' },
    
            { 'municipality': 'Concepcion', 'barangay': 'Bagong Nayon' },
            { 'municipality': 'Concepcion', 'barangay': 'Capule' },
            { 'municipality': 'Concepcion', 'barangay': 'New Casul' },
            { 'municipality': 'Concepcion', 'barangay': 'Guiban' },
            { 'municipality': 'Concepcion', 'barangay': 'Laya-an' },
            { 'municipality': 'Concepcion', 'barangay': 'Lingatongan' },
            { 'municipality': 'Concepcion', 'barangay': 'Maligubaan' },
            { 'municipality': 'Concepcion', 'barangay': 'Mantukoy' },
            { 'municipality': 'Concepcion', 'barangay': 'Marugang' },
            { 'municipality': 'Concepcion', 'barangay': 'Poblacion' },
            { 'municipality': 'Concepcion', 'barangay': 'Pogan' },
            { 'municipality': 'Concepcion', 'barangay': 'Small Potongan' },
            { 'municipality': 'Concepcion', 'barangay': 'Soso-on' },
            { 'municipality': 'Concepcion', 'barangay': 'Upper Dapitan' },
            { 'municipality': 'Concepcion', 'barangay': 'Upper Dioyo' },
            { 'municipality': 'Concepcion', 'barangay': 'Upper Potongan' },
            { 'municipality': 'Concepcion', 'barangay': 'Upper Salimpono' },
            { 'municipality': 'Concepcion', 'barangay': 'Virayan' },
    
            { 'municipality': 'Jimenez', 'barangay': 'Adorable' },
            { 'municipality': 'Jimenez', 'barangay': 'Butuay' },
            { 'municipality': 'Jimenez', 'barangay': 'Carmen' },
            { 'municipality': 'Jimenez', 'barangay': 'Corrales' },
            { 'municipality': 'Jimenez', 'barangay': 'Dicoloc' },
            { 'municipality': 'Jimenez', 'barangay': 'Gata' },
            { 'municipality': 'Jimenez', 'barangay': 'Guintomoyan' },
            { 'municipality': 'Jimenez', 'barangay': 'Malibacsan' },
            { 'municipality': 'Jimenez', 'barangay': 'Macabayao' },
            { 'municipality': 'Jimenez', 'barangay': 'Matugas Alto' },
            { 'municipality': 'Jimenez', 'barangay': 'Matugas Bajo' },
            { 'municipality': 'Jimenez', 'barangay': 'Mialem' },
            { 'municipality': 'Jimenez', 'barangay': 'Naga (Poblacion)' },
            { 'municipality': 'Jimenez', 'barangay': 'Palilan' },
            { 'municipality': 'Jimenez', 'barangay': 'Nacional (Poblacion)' },
            { 'municipality': 'Jimenez', 'barangay': 'Rizal (Poblacion)' },
            { 'municipality': 'Jimenez', 'barangay': 'San Isidro' },
            { 'municipality': 'Jimenez', 'barangay': 'Santa Cruz (Poblacion)' },
            { 'municipality': 'Jimenez', 'barangay': 'Sibaroc' },
            { 'municipality': 'Jimenez', 'barangay': 'Sinara Alto' },
            { 'municipality': 'Jimenez', 'barangay': 'Sinara Bajo' },
            { 'municipality': 'Jimenez', 'barangay': 'Seti' },
            { 'municipality': 'Jimenez', 'barangay': 'Tabo-o' },
            { 'municipality': 'Jimenez', 'barangay': 'Taraka (Poblacion)' },
    
            { 'municipality': 'Lopez Jaena', 'barangay': 'Alegria' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Bagong Silang' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Biasong' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Bonifacio' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Burgos' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Dalacon' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Dampalan' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Estante' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Hasa-an' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Katipa' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Luzaran' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Macalibre Alto' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Macalibre Bajo' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Mahayahay' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Manguehan' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Mansabay Bajo' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Molatuhan Alto' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Molatuhan Bajo' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Peniel' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Eastern Poblacion' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Puntod' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Rizal' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Sibugon' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Sibula' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Don Andres Soriano' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Mabas' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Mansabay Alto' },
            { 'municipality': 'Lopez Jaena', 'barangay': 'Western Poblacion' },
    
            { 'municipality': 'Oroquieta City', 'barangay': 'Apil' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Binuangan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Bolibol' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Buenavista' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Bunga' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Buntawan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Burgos' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Canubay' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Clarin Settlement' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Dolipos Bajo' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Dolipos Alto' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Dulapo' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Dullan Norte' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Dullan Sur' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Lower Lamac' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Layawan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Lower Langcangan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Lower Loboc' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Lower Rizal' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Malindang' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Mialen' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Mobod' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Ciriaco C. Pastrano (Nilabo)' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Paypayan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Pines' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Poblacion I' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Poblacion II' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Proper Langcangan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'San Vicente Alto (Dagatan)' },
            { 'municipality': 'Oroquieta City', 'barangay': 'San Vicente Bajo (Baybay Dagatan)' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Sebucal' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Senote' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Taboc Norte' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Taboc Sur' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Talairon' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Talic' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Toliyok' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Tipan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Tuyabang Alto' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Tuyabang Bajo' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Tuyabang Proper' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Upper Langcangan' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Upper Lamac' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Upper Loboc' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Upper Rizal (Tipalac)' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Victoria' },
            { 'municipality': 'Oroquieta City', 'barangay': 'Villaflor (Transville)' },
    
            { 'municipality': 'Ozamiz City', 'barangay': '50th District (Poblacion)' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Aguada (Poblacion)' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Bacolod' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Bagakay' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Balintawak' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Baå˜adero (Poblacion)' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Baybay San Roque' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Baybay Santa Cruz' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Baybay Triunfo' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Bongbong' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Calabayan' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Capucao C.' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Capucao P.' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Carangan' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Carmen (Misamis Annex)' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Catadman-Manabay' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Cavinte' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Cogon' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Dalapang' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Diguan' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Dimaluna' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Doå˜a Consuelo' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Embargo' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Gala' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Gango' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Gotokan Daku' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Gotokan Diot' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Guimad' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Guingona' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Kinuman Norte' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Kinuman Sur' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Labinay' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Labo' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Lam-an' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Liposong' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Litapan' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Malaubang' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Manaka' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Maningcol' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Mentering' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Molicay' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Pantaon' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Pulot' },
            { 'municipality': 'Ozamiz City', 'barangay': 'San Antonio' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Sangay Daku' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Sangay Diot' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Sinuza' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Stimson' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Tabid' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Tinago' },
            { 'municipality': 'Ozamiz City', 'barangay': 'Trigos' }
        ],
        'skills': ['Science', 'Math', 'English', 'Music', 'Arts', 'Culinary Arts']
    };

     // Populate municipality dropdown
     const municipalityDropdown = document.getElementById('municipalityDropdown');
     address.municipalities.forEach(municipality => {
         const option = document.createElement('option');
         option.value = municipality;
         option.text = municipality;
         municipalityDropdown.add(option);
     });
 
     // Populate barangay dropdown based on selected municipality
     const barangayDropdown = document.getElementById('barangayDropdown');
     const updateBarangayDropdown = () => {
         const selectedMunicipality = municipalityDropdown.value;
         const barangays = address.barangays.filter(entry => entry.municipality === selectedMunicipality);
 
         // Clear previous options
         barangayDropdown.innerHTML = '';
 
         // Populate new options
         barangays.forEach(barangay => {
             const option = document.createElement('option');
             option.value = barangay.barangay;
             option.text = barangay.barangay;
             barangayDropdown.add(option);
         });
     };
 
     // Initial update
     updateBarangayDropdown();
 
     // Attach event listener for municipality change
     municipalityDropdown.addEventListener('change', updateBarangayDropdown);
 
     // Populate skills dropdown
     const skillsDropdown = document.getElementById('skillsDropdown');
     const updateSkillsDropdown = () => {
         // Clear previous options
         skillsDropdown.innerHTML = '';
 
         // Populate new options
         address.skills.forEach(skill => {
             const option = document.createElement('option');
             option.value = skill;
             option.text = skill;
             skillsDropdown.add(option);
         });
     };
 
     // Initial update
     updateSkillsDropdown();
 });