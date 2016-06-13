<?php

global $psp;

/*
from: http://schema.org/docs/full.html

var $lb = $('a[href="../LocalBusiness"]').eq(1),
$parent = $lb.parents('table.h').eq(0),
$rows = $parent.find('> tbody > tr').filter(function(i) {
    return i>0;
});

$rows.each(function (i, elem) {
    var $that = $(this),
    $group = $that.find('> td > table.h > tbody > tr'),
    $groupTitle = $group.find('> td.tc'),
    groupTitle = $groupTitle.find('a').text(),
    $groupItems = $group.find('> td > table.h > tbody > tr');
    
    //console.log('<optgroup label="'+groupTitle+'">');
    console.log("'" + groupTitle + "' => array(");
    
    var len = $groupItems.length;
    if (len == 0)
        console.log("\t'" + groupTitle
        + "' => __('" + groupTitle + "', $psp->localizationName)");

    $groupItems.each(function (i2, e2) {
        var $item = $(this),
        $item2 = $item.find('> td.tc'),
        itemTitle = $item2.find('a').text();
        
        //console.log('\t<option value="'+itemTitle+'">'+itemTitle+'</option>');
        console.log("\t'" + itemTitle
        + "' => __('" + itemTitle + "', $psp->localizationName)"
        + ( i2 == len - 1 ? '' : ',' ));
    });
    
    //console.log('</optgroup>');
    console.log("),");
    
});

*/

$psp_business_type_list = array(
	'AnimalShelter' => array(
	
		'AnimalShelter' => __('AnimalShelter', $psp->localizationName)
	
	),
	'AutomotiveBusiness' => array(
	
		'AutoBodyShop' => __('AutoBodyShop', $psp->localizationName),
	
		'AutoDealer' => __('AutoDealer', $psp->localizationName),
	
		'AutoPartsStore*' => __('AutoPartsStore*', $psp->localizationName),
	
		'AutoRental' => __('AutoRental', $psp->localizationName),
	
		'AutoRepair' => __('AutoRepair', $psp->localizationName),
	
		'AutoWash' => __('AutoWash', $psp->localizationName),
	
		'GasStation' => __('GasStation', $psp->localizationName),
	
		'MotorcycleDealer' => __('MotorcycleDealer', $psp->localizationName),
	
		'MotorcycleRepair' => __('MotorcycleRepair', $psp->localizationName)
	
	),
	'ChildCare' => array(
	
		'ChildCare' => __('ChildCare', $psp->localizationName)
	
	),
	'DryCleaningOrLaundry' => array(
	
		'DryCleaningOrLaundry' => __('DryCleaningOrLaundry', $psp->localizationName)
	
	),
	'EmergencyService' => array(
	
		'FireStation*' => __('FireStation*', $psp->localizationName),
	
		'Hospital*' => __('Hospital*', $psp->localizationName),
	
		'PoliceStation*' => __('PoliceStation*', $psp->localizationName)
	
	),
	'EmploymentAgency' => array(
	
		'EmploymentAgency' => __('EmploymentAgency', $psp->localizationName)
	
	),
	'EntertainmentBusiness' => array(
	
		'AdultEntertainment' => __('AdultEntertainment', $psp->localizationName),
	
		'AmusementPark' => __('AmusementPark', $psp->localizationName),
	
		'ArtGallery' => __('ArtGallery', $psp->localizationName),
	
		'Casino' => __('Casino', $psp->localizationName),
	
		'ComedyClub' => __('ComedyClub', $psp->localizationName),
	
		'MovieTheater*' => __('MovieTheater*', $psp->localizationName),
	
		'NightClub' => __('NightClub', $psp->localizationName)
	
	),
	'FinancialService' => array(
	
		'AccountingService*' => __('AccountingService*', $psp->localizationName),
	
		'AutomatedTeller' => __('AutomatedTeller', $psp->localizationName),
	
		'BankOrCreditUnion' => __('BankOrCreditUnion', $psp->localizationName),
	
		'InsuranceAgency' => __('InsuranceAgency', $psp->localizationName)
	
	),
	'FoodEstablishment' => array(
	
		'Bakery' => __('Bakery', $psp->localizationName),
	
		'BarOrPub' => __('BarOrPub', $psp->localizationName),
	
		'Brewery' => __('Brewery', $psp->localizationName),
	
		'CafeOrCoffeeShop' => __('CafeOrCoffeeShop', $psp->localizationName),
	
		'FastFoodRestaurant' => __('FastFoodRestaurant', $psp->localizationName),
	
		'IceCreamShop' => __('IceCreamShop', $psp->localizationName),
	
		'Restaurant' => __('Restaurant', $psp->localizationName),
	
		'Winery' => __('Winery', $psp->localizationName)
	
	),
	'GovernmentOffice' => array(
	
		'PostOffice' => __('PostOffice', $psp->localizationName)
	
	),
	'HealthAndBeautyBusiness' => array(
	
		'BeautySalon' => __('BeautySalon', $psp->localizationName),
	
		'DaySpa' => __('DaySpa', $psp->localizationName),
	
		'HairSalon' => __('HairSalon', $psp->localizationName),
	
		'HealthClub*' => __('HealthClub*', $psp->localizationName),
	
		'NailSalon' => __('NailSalon', $psp->localizationName),
	
		'TattooParlor' => __('TattooParlor', $psp->localizationName)
	
	),
	'HomeAndConstructionBusiness' => array(
	
		'Electrician*' => __('Electrician*', $psp->localizationName),
	
		'GeneralContractor*' => __('GeneralContractor*', $psp->localizationName),
	
		'HVACBusiness' => __('HVACBusiness', $psp->localizationName),
	
		'HousePainter*' => __('HousePainter*', $psp->localizationName),
	
		'Locksmith*' => __('Locksmith*', $psp->localizationName),
	
		'MovingCompany' => __('MovingCompany', $psp->localizationName),
	
		'Plumber*' => __('Plumber*', $psp->localizationName),
	
		'RoofingContractor*' => __('RoofingContractor*', $psp->localizationName)
	
	),
	'InternetCafe' => array(
	
		'InternetCafe' => __('InternetCafe', $psp->localizationName)
	
	),
	'Library' => array(
	
		'Library' => __('Library', $psp->localizationName)
	
	),
	'LodgingBusiness' => array(
	
		'BedAndBreakfast' => __('BedAndBreakfast', $psp->localizationName),
	
		'Hostel' => __('Hostel', $psp->localizationName),
	
		'Hotel' => __('Hotel', $psp->localizationName),
	
		'Motel' => __('Motel', $psp->localizationName)
	
	),
	'MedicalOrganization' => array(
	
		'Dentist*' => __('Dentist*', $psp->localizationName),
	
		'DiagnosticLab' => __('DiagnosticLab', $psp->localizationName),
	
		'Hospital*' => __('Hospital*', $psp->localizationName),
	
		'MedicalClinic' => __('MedicalClinic', $psp->localizationName),
	
		'Optician' => __('Optician', $psp->localizationName),
	
		'Pharmacy' => __('Pharmacy', $psp->localizationName),
	
		'Physician' => __('Physician', $psp->localizationName),
	
		'VeterinaryCare' => __('VeterinaryCare', $psp->localizationName)
	
	),
	'ProfessionalService' => array(
	
		'AccountingService*' => __('AccountingService*', $psp->localizationName),
	
		'Attorney' => __('Attorney', $psp->localizationName),
	
		'Dentist*' => __('Dentist*', $psp->localizationName),
	
		'Electrician*' => __('Electrician*', $psp->localizationName),
	
		'GeneralContractor*' => __('GeneralContractor*', $psp->localizationName),
	
		'HousePainter*' => __('HousePainter*', $psp->localizationName),
	
		'Locksmith*' => __('Locksmith*', $psp->localizationName),
	
		'Notary' => __('Notary', $psp->localizationName),
	
		'Plumber*' => __('Plumber*', $psp->localizationName),
	
		'RoofingContractor*' => __('RoofingContractor*', $psp->localizationName)
	
	),
	'RadioStation' => array(
	
		'RadioStation' => __('RadioStation', $psp->localizationName)
	
	),
	'RealEstateAgent' => array(
	
		'RealEstateAgent' => __('RealEstateAgent', $psp->localizationName)
	
	),
	'RecyclingCenter' => array(
	
		'RecyclingCenter' => __('RecyclingCenter', $psp->localizationName)
	
	),
	'SelfStorage' => array(
	
		'SelfStorage' => __('SelfStorage', $psp->localizationName)
	
	),
	'ShoppingCenter' => array(
	
		'ShoppingCenter' => __('ShoppingCenter', $psp->localizationName)
	
	),
	'SportsActivityLocation' => array(
	
		'BowlingAlley' => __('BowlingAlley', $psp->localizationName),
	
		'ExerciseGym' => __('ExerciseGym', $psp->localizationName),
	
		'GolfCourse' => __('GolfCourse', $psp->localizationName),
	
		'HealthClub*' => __('HealthClub*', $psp->localizationName),
	
		'PublicSwimmingPool' => __('PublicSwimmingPool', $psp->localizationName),
	
		'SkiResort' => __('SkiResort', $psp->localizationName),
	
		'SportsClub' => __('SportsClub', $psp->localizationName),
	
		'StadiumOrArena*' => __('StadiumOrArena*', $psp->localizationName),
	
		'TennisComplex' => __('TennisComplex', $psp->localizationName)
	
	),
	'Store' => array(
	
		'AutoPartsStore*' => __('AutoPartsStore*', $psp->localizationName),
	
		'BikeStore' => __('BikeStore', $psp->localizationName),
	
		'BookStore' => __('BookStore', $psp->localizationName),
	
		'ClothingStore' => __('ClothingStore', $psp->localizationName),
	
		'ComputerStore' => __('ComputerStore', $psp->localizationName),
	
		'ConvenienceStore' => __('ConvenienceStore', $psp->localizationName),
	
		'DepartmentStore' => __('DepartmentStore', $psp->localizationName),
	
		'ElectronicsStore' => __('ElectronicsStore', $psp->localizationName),
	
		'Florist' => __('Florist', $psp->localizationName),
	
		'FurnitureStore' => __('FurnitureStore', $psp->localizationName),
	
		'GardenStore' => __('GardenStore', $psp->localizationName),
	
		'GroceryStore' => __('GroceryStore', $psp->localizationName),
	
		'HardwareStore' => __('HardwareStore', $psp->localizationName),
	
		'HobbyShop' => __('HobbyShop', $psp->localizationName),
	
		'HomeGoodsStore' => __('HomeGoodsStore', $psp->localizationName),
	
		'JewelryStore' => __('JewelryStore', $psp->localizationName),
	
		'LiquorStore' => __('LiquorStore', $psp->localizationName),
	
		'MensClothingStore' => __('MensClothingStore', $psp->localizationName),
	
		'MobilePhoneStore' => __('MobilePhoneStore', $psp->localizationName),
	
		'MovieRentalStore' => __('MovieRentalStore', $psp->localizationName),
	
		'MusicStore' => __('MusicStore', $psp->localizationName),
	
		'OfficeEquipmentStore' => __('OfficeEquipmentStore', $psp->localizationName),
	
		'OutletStore' => __('OutletStore', $psp->localizationName),
	
		'PawnShop' => __('PawnShop', $psp->localizationName),
	
		'PetStore' => __('PetStore', $psp->localizationName),
	
		'ShoeStore' => __('ShoeStore', $psp->localizationName),
	
		'SportingGoodsStore' => __('SportingGoodsStore', $psp->localizationName),
	
		'TireShop' => __('TireShop', $psp->localizationName),
	
		'ToyStore' => __('ToyStore', $psp->localizationName),
	
		'WholesaleStore' => __('WholesaleStore', $psp->localizationName)
	
	),
	'TelevisionStation' => array(
	
		'TelevisionStation' => __('TelevisionStation', $psp->localizationName)
	
	),
	'TouristInformationCenter' => array(
	
		'TouristInformationCenter' => __('TouristInformationCenter', $psp->localizationName)
	
	),
	'TravelAgency' => array(
	
		'TravelAgency' => __('TravelAgency', $psp->localizationName)
	
	)
);


/*
from: http://www.state.gov/misc/list/

var $blocks = $('blockquote[dir="ltr"]');
$blocks.each(function (i,e) {
    var $that = $(this), $rows = $that.find('> p > a');
    $rows.each(function (i2, e2) {
        var country = $(this).text();
        country = $.trim(country);
        country = country.replace(/'/g, "\\'");
        console.log( "'" + country + "' => '" + country
        + "',");
    });
});
*/

$psp_countries_list = array(
	'Afghanistan' => 'Afghanistan',
	'Albania' => 'Albania',
	'Algeria' => 'Algeria',
	'Andorra' => 'Andorra',
	'Angola' => 'Angola',
	'Antigua and Barbuda' => 'Antigua and Barbuda',
	'Argentina' => 'Argentina',
	'Armenia' => 'Armenia',
	'Aruba' => 'Aruba',
	'Australia' => 'Australia',
	'Austria' => 'Austria',
	'Azerbaijan' => 'Azerbaijan',
	'Bahamas, The' => 'Bahamas, The',
	'Bahrain' => 'Bahrain',
	'Bangladesh' => 'Bangladesh',
	'Barbados' => 'Barbados',
	'Belarus' => 'Belarus',
	'Belgium' => 'Belgium',
	'Belize' => 'Belize',
	'Benin' => 'Benin',
	'Bhutan' => 'Bhutan',
	'Bolivia' => 'Bolivia',
	'Bosnia and Herzegovina' => 'Bosnia and Herzegovina',
	'Botswana' => 'Botswana',
	'Brazil' => 'Brazil',
	'Brunei' => 'Brunei',
	'Bulgaria' => 'Bulgaria',
	'Burkina Faso' => 'Burkina Faso',
	'Burma' => 'Burma',
	'Burundi' => 'Burundi',
	'Cambodia' => 'Cambodia',
	'Cameroon' => 'Cameroon',
	'Canada' => 'Canada',
	'Cape Verde' => 'Cape Verde',
	'Central African Republic' => 'Central African Republic',
	'Chad' => 'Chad',
	'Chile' => 'Chile',
	'China' => 'China',
	'Colombia' => 'Colombia',
	'Comoros' => 'Comoros',
	'Congo, Democratic Republic of the' => 'Congo, Democratic Republic of the',
	'Congo, Republic of the' => 'Congo, Republic of the',
	'Costa Rica' => 'Costa Rica',
	'Cote d\'Ivoire' => 'Cote d\'Ivoire',
	'Croatia' => 'Croatia',
	'Cuba' => 'Cuba',
	'Curacao' => 'Curacao',
	'Cyprus' => 'Cyprus',
	'Czech Republic' => 'Czech Republic',
	'Denmark' => 'Denmark',
	'Djibouti' => 'Djibouti',
	'Dominica' => 'Dominica',
	'Dominican Republic' => 'Dominican Republic',
	'Timor-Leste' => 'Timor-Leste',
	'Ecuador' => 'Ecuador',
	'Egypt' => 'Egypt',
	'El Salvador' => 'El Salvador',
	'Equatorial Guinea' => 'Equatorial Guinea',
	'Eritrea' => 'Eritrea',
	'Estonia' => 'Estonia',
	'Ethiopia' => 'Ethiopia',
	'Fiji' => 'Fiji',
	'Finland' => 'Finland',
	'France' => 'France',
	'Gabon' => 'Gabon',
	'Gambia, The' => 'Gambia, The',
	'Georgia' => 'Georgia',
	'Germany' => 'Germany',
	'Ghana' => 'Ghana',
	'Greece' => 'Greece',
	'Grenada' => 'Grenada',
	'Guatemala' => 'Guatemala',
	'Guinea' => 'Guinea',
	'Guinea-Bissau' => 'Guinea-Bissau',
	'Guyana' => 'Guyana',
	'Haiti' => 'Haiti',
	'Holy See' => 'Holy See',
	'Honduras' => 'Honduras',
	'Hong Kong' => 'Hong Kong',
	'Hungary' => 'Hungary',
	'Iceland' => 'Iceland',
	'India' => 'India',
	'Indonesia' => 'Indonesia',
	'Iran' => 'Iran',
	'Iraq' => 'Iraq',
	'Ireland' => 'Ireland',
	'Israel' => 'Israel',
	'Italy' => 'Italy',
	'Jamaica' => 'Jamaica',
	'Japan' => 'Japan',
	'Jordan' => 'Jordan',
	'Kazakhstan' => 'Kazakhstan',
	'Kenya' => 'Kenya',
	'Kiribati' => 'Kiribati',
	'Korea, North' => 'Korea, North',
	'Korea, South' => 'Korea, South',
	'Kosovo' => 'Kosovo',
	'Kuwait' => 'Kuwait',
	'Kyrgyzstan' => 'Kyrgyzstan',
	'Laos' => 'Laos',
	'Latvia' => 'Latvia',
	'Lebanon' => 'Lebanon',
	'Lesotho' => 'Lesotho',
	'Liberia' => 'Liberia',
	'Libya' => 'Libya',
	'Liechtenstein' => 'Liechtenstein',
	'Lithuania' => 'Lithuania',
	'Luxembourg' => 'Luxembourg',
	'Macau' => 'Macau',
	'Macedonia' => 'Macedonia',
	'Madagascar' => 'Madagascar',
	'Malawi' => 'Malawi',
	'Malaysia' => 'Malaysia',
	'Maldives' => 'Maldives',
	'Mali' => 'Mali',
	'Malta' => 'Malta',
	'Marshall Islands' => 'Marshall Islands',
	'Mauritania' => 'Mauritania',
	'Mauritius' => 'Mauritius',
	'Mexico' => 'Mexico',
	'Micronesia' => 'Micronesia',
	'Moldova' => 'Moldova',
	'Monaco' => 'Monaco',
	'Mongolia' => 'Mongolia',
	'Montenegro' => 'Montenegro',
	'Morocco' => 'Morocco',
	'Mozambique' => 'Mozambique',
	'Namibia' => 'Namibia',
	'Nauru' => 'Nauru',
	'Nepal' => 'Nepal',
	'Netherlands' => 'Netherlands',
	'Netherlands Antilles' => 'Netherlands Antilles',
	'New Zealand' => 'New Zealand',
	'Nicaragua' => 'Nicaragua',
	'Niger' => 'Niger',
	'Nigeria' => 'Nigeria',
	'North Korea' => 'North Korea',
	'Norway' => 'Norway',
	'Oman' => 'Oman',
	'Pakistan' => 'Pakistan',
	'Palau' => 'Palau',
	'Palestinian Territories' => 'Palestinian Territories',
	'Panama' => 'Panama',
	'Papua New Guinea' => 'Papua New Guinea',
	'Paraguay' => 'Paraguay',
	'Peru' => 'Peru',
	'Philippines' => 'Philippines',
	'Poland' => 'Poland',
	'Portugal' => 'Portugal',
	'Qatar' => 'Qatar',
	'Romania' => 'Romania',
	'Russia' => 'Russia',
	'Rwanda' => 'Rwanda',
	'Saint Kitts and Nevis' => 'Saint Kitts and Nevis',
	'Saint Lucia' => 'Saint Lucia',
	'Saint Vincent and the Grenadines' => 'Saint Vincent and the Grenadines',
	'Samoa' => 'Samoa',
	'San Marino' => 'San Marino',
	'Sao Tome and Principe' => 'Sao Tome and Principe',
	'Saudi Arabia' => 'Saudi Arabia',
	'Senegal' => 'Senegal',
	'Serbia' => 'Serbia',
	'Seychelles' => 'Seychelles',
	'Sierra Leone' => 'Sierra Leone',
	'Singapore' => 'Singapore',
	'Sint Maarten' => 'Sint Maarten',
	'Slovakia' => 'Slovakia',
	'Slovenia' => 'Slovenia',
	'Solomon Islands' => 'Solomon Islands',
	'Somalia' => 'Somalia',
	'South Africa' => 'South Africa',
	'South Korea' => 'South Korea',
	'South Sudan' => 'South Sudan',
	'Spain' => 'Spain',
	'Sri Lanka' => 'Sri Lanka',
	'Sudan' => 'Sudan',
	'Suriname' => 'Suriname',
	'Swaziland' => 'Swaziland',
	'Sweden' => 'Sweden',
	'Switzerland' => 'Switzerland',
	'Syria' => 'Syria',
	'Taiwan' => 'Taiwan',
	'Tajikistan' => 'Tajikistan',
	'Tanzania' => 'Tanzania',
	'Thailand' => 'Thailand',
	'Timor-Leste' => 'Timor-Leste',
	'Togo' => 'Togo',
	'Tonga' => 'Tonga',
	'Trinidad and Tobago' => 'Trinidad and Tobago',
	'Tunisia' => 'Tunisia',
	'Turkey' => 'Turkey',
	'Turkmenistan' => 'Turkmenistan',
	'Tuvalu' => 'Tuvalu',
	'Uganda' => 'Uganda',
	'Ukraine' => 'Ukraine',
	'United Arab Emirates' => 'United Arab Emirates',
	'United Kingdom' => 'United Kingdom',
	'United States of America' => 'United States of America',
	'Uruguay' => 'Uruguay',
	'Uzbekistan' => 'Uzbekistan',
	'Vanuatu' => 'Vanuatu',
	'Venezuela' => 'Venezuela',
	'Vietnam' => 'Vietnam',
	'Yemen' => 'Yemen',
	'Zambia' => 'Zambia',
	'Zimbabwe' => 'Zimbabwe'
);


$psp_days_list = array(
	'monday'		=> __('Monday', $psp->localizationName),
	'tuesday'		=> __('Tuesday', $psp->localizationName),
	'wednesday'		=> __('Wednesday', $psp->localizationName),
	'thursday'		=> __('Thursday', $psp->localizationName),
	'friday'		=> __('Friday', $psp->localizationName),
	'saturday'		=> __('Saturday', $psp->localizationName),
	'sunday'		=> __('Sunday', $psp->localizationName)
);

?>