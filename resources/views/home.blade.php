@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-md-6 col-sm-8 col-6">
                    <h3 class="user-itesm-title">User Items (Grid View)</h3>
                </div>
                <div class="col-md-6 col-sm-4 col-6">
                    <div class="create-new-items">
                        <button class="btn btn-primary me-2 clicked" type="button" id="productFormSm" data-bs-original-title="" title="">
                            <span class="me-2 d-none d-md-flex">Add Single Product</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down d-none d-md-flex">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus d-flex d-md-none">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </button>
                        <button class="d-none d-md-flex btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#product-modal-2" data-bs-original-title="" title="">
                            <span class="me-2">Bulk Image Upload</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud">
                                <polyline points="16 16 12 12 8 16"></polyline>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                                <polyline points="16 16 12 12 8 16"></polyline>
                            </svg>
                        </button>
                        <button class="d-flex d-md-none btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#product-modal-2" data-bs-original-title="" title="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud">
                                <polyline points="16 16 12 12 8 16"></polyline>
                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                                <polyline points="16 16 12 12 8 16"></polyline>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- new product form start -->
            <div class="col-12 product-form-area">
                <div class="card">
                    <div class="card-header">
                        <h5>Add new products</h5>
                        <span>Please fill up the form below to add new products</span>
                    </div>
                    <div class="card-body">
                        <form class="theme-form">
                            <div class="row">
                                <div class="col-xl-6 col-6 mb-3">
                                    <div class="row">
                                        <div class="col-xxl-7 col-xl-6 col-md-8 col-sm-7 newItem">
                                            <select class="js-example-basic-single col-sm-12 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="" selected="">Select Category</option>
                                                <option value="">Category-1</option>
                                                <option value="">Category-2</option>
                                                <option value="">Category-3</option>
                                                <option value="">Category-4</option>
                                                <option value="">Category-5</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 305.337px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-r2ld-container"><span class="select2-selection__rendered" id="select2-r2ld-container" title="Select Category">Select Category</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                        <div class="col-xxl-5 col-xl-6 col-md-4 col-sm-auto ms-md-0 mt-sm-0 ms-auto mt-3 text-end newItemBtn">
                                            <button class="btn btn-primary new-shop-btn cus-new-shop-btn" type="button" data-bs-toggle="modal" data-bs-target="#createNewCate" data-bs-original-title="" title="">
                                                <span>New Category</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-6 mb-3">
                                    <div class="row">
                                        <div class="col-xxl-7 col-xl-6 col-md-8 col-sm-7 newItem">
                                            <select class="js-example-basic-single col-sm-12 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                                <option value="" selected="">Select Shop</option>
                                                <option value="">Shop-1</option>
                                                <option value="">Shop-2</option>
                                                <option value="">Shop-3</option>
                                                <option value="">Shop-4</option>
                                                <option value="">Shop-5</option>
                                            </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 305.337px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-k40y-container"><span class="select2-selection__rendered" id="select2-k40y-container" title="Select Shop">Select Shop</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                        <div class="col-xxl-5 col-xl-6 col-md-4 col-sm-auto ms-md-0 mt-sm-0 ms-auto mt-3 text-end newItemBtn">
                                            <button class="btn btn-primary new-shop-btn cus-new-shop-btn" type="button" data-bs-toggle="modal" data-bs-target="#createNewShop" data-bs-original-title="" title="">
                                                <span>Add New Shop</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-3 product-name-field">
                                    <input class="form-control" type="text" placeholder="Product Name" data-bs-original-title="" title="">
                                </div>
                                <div class="col-lg-6 mb-3  d-md-flex">
                                    <select class="js-example-basic-single country-list col-sm-12 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        <option value="Afghanistan" data-icon="fi-af">Afghanistan</option>
                                        <option value="Albania" data-icon="fi-al">Albania</option>
                                        <option value="Algeria" data-icon="fi-dz">Algeria</option>
                                        <option value="American Samoa" data-icon="fi-as">American Samoa</option>
                                        <option value="Andorra" data-icon="fi-ad">Andorra</option>
                                        <option value="Angola" data-icon="fi-ao">Angola</option>
                                        <option value="Anguilla" data-icon="fi-ai">Anguilla</option>
                                        <option value="Antarctica" data-icon="fi-aq">Antarctica</option>
                                        <option value="Antigua and Barbuda" data-icon="fi-ag">Antigua and Barbuda</option>
                                        <option value="Argentina" data-icon="fi-ar">Argentina</option>
                                        <option value="Armenia" data-icon="fi-am">Armenia</option>
                                        <option value="Aruba" data-icon="fi-aw">Aruba</option>
                                        <option value="Australia" data-icon="fi-au">Australia</option>
                                        <option value="Austria" data-icon="fi-at">Austria</option>
                                        <option value="Azerbaijan" data-icon="fi-az">Azerbaijan</option>
                                        <option value="Bahamas (the)" data-icon="fi-bs">Bahamas (the)</option>
                                        <option value="Bahrain" data-icon="fi-bh">Bahrain</option>
                                        <option value="Bangladesh" data-icon="fi-bd">Bangladesh</option>
                                        <option value="Barbados" data-icon="fi-bb">Barbados</option>
                                        <option value="Belarus" data-icon="fi-by">Belarus</option>
                                        <option value="Belgium" data-icon="fi-be">Belgium</option>
                                        <option value="Belize" data-icon="fi-bz">Belize</option>
                                        <option value="Benin" data-icon="fi-bj">Benin</option>
                                        <option value="Bermuda" data-icon="fi-bm">Bermuda</option>
                                        <option value="Bhutan" data-icon="fi-bt">Bhutan</option>
                                        <option value="Bolivia (Plurinational State of)" data-icon="fi-bo">Bolivia (Plurinational State of)</option>
                                        <option value="Bonaire, Sint Eustatius and Saba" data-icon="fi-bq">Bonaire, Sint Eustatius and Saba</option>
                                        <option value="Bosnia and Herzegovina" data-icon="fi-ba">Bosnia and Herzegovina</option>
                                        <option value="Botswana" data-icon="fi-bw">Botswana</option>
                                        <option value="Bouvet Island" data-icon="fi-bv">Bouvet Island</option>
                                        <option value="Brazil" data-icon="fi-br">Brazil</option>
                                        <option value="British Indian Ocean Territory (the)" data-icon="fi-io">British Indian Ocean Territory (the)</option>
                                        <option value="Brunei Darussalam" data-icon="fi-bn">Brunei Darussalam</option>
                                        <option value="Bulgaria" data-icon="fi-bg">Bulgaria</option>
                                        <option value="Burkina Faso" data-icon="fi-bf">Burkina Faso</option>
                                        <option value="Burundi" data-icon="fi-bi">Burundi</option>
                                        <option value="Cabo Verde" data-icon="fi-cv">Cabo Verde</option>
                                        <option value="Cambodia" data-icon="fi-kh">Cambodia</option>
                                        <option value="Cameroon" data-icon="fi-cm">Cameroon</option>
                                        <option value="Canada" data-icon="fi-ca">Canada</option>
                                        <option value="Cayman Islands (the)" data-icon="fi-ky">Cayman Islands (the)</option>
                                        <option value="Central African Republic (the)" data-icon="fi-cf">Central African Republic (the)</option>
                                        <option value="Chad" data-icon="fi-td">Chad</option>
                                        <option value="Chile" data-icon="fi-cl">Chile</option>
                                        <option value="China" data-icon="fi-cn">China</option>
                                        <option value="Christmas Island" data-icon="fi-cx">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands (the)" data-icon="fi-cc">Cocos (Keeling) Islands (the)</option>
                                        <option value="Colombia" data-icon="fi-co">Colombia</option>
                                        <option value="Comoros (the)" data-icon="fi-km">Comoros (the)</option>
                                        <option value="Congo (the Democratic Republic of the)" data-icon="fi-cd">Congo (the Democratic Republic of the)</option>
                                        <option value="Congo (the)" data-icon="fi-cg">Congo (the)</option>
                                        <option value="Cook Islands (the)" data-icon="fi-ck">Cook Islands (the)</option>
                                        <option value="Costa Rica" data-icon="fi-cr">Costa Rica</option>
                                        <option value="Croatia" data-icon="fi-hr">Croatia</option>
                                        <option value="Cuba" data-icon="fi-cu">Cuba</option>
                                        <option value="Curaçao" data-icon="fi-cw">Curaçao</option>
                                        <option value="Cyprus" data-icon="fi-cy">Cyprus</option>
                                        <option value="Czechia" data-icon="fi-cz">Czechia</option>
                                        <option value="Côte d'Ivoire" data-icon="fi-ci">Côte d'Ivoire</option>
                                        <option value="Denmark" data-icon="fi-dk">Denmark</option>
                                        <option value="Djibouti" data-icon="fi-dj">Djibouti</option>
                                        <option value="Dominica" data-icon="fi-dm">Dominica</option>
                                        <option value="Dominican Republic (the)" data-icon="fi-do">Dominican Republic (the)</option>
                                        <option value="Ecuador" data-icon="fi-ec">Ecuador</option>
                                        <option value="Egypt" data-icon="fi-eg">Egypt</option>
                                        <option value="El Salvador" data-icon="fi-sv">El Salvador</option>
                                        <option value="Equatorial Guinea" data-icon="fi-gq">Equatorial Guinea</option>
                                        <option value="Eritrea" data-icon="fi-er">Eritrea</option>
                                        <option value="Estonia" data-icon="fi-ee">Estonia</option>
                                        <option value="Eswatini" data-icon="fi-sz">Eswatini</option>
                                        <option value="Ethiopia" data-icon="fi-et">Ethiopia</option>
                                        <option value="Falkland Islands (the) [Malvinas]" data-icon="fi-fk">Falkland Islands (the) [Malvinas]</option>
                                        <option value="Faroe Islands (the)" data-icon="fi-fo">Faroe Islands (the)</option>
                                        <option value="Fiji" data-icon="fi-fj">Fiji</option>
                                        <option value="Finland" data-icon="fi-fi">Finland</option>
                                        <option value="France" data-icon="fi-fr">France</option>
                                        <option value="French Guiana" data-icon="fi-gf">French Guiana</option>
                                        <option value="French Polynesia" data-icon="fi-pf">French Polynesia</option>
                                        <option value="French Southern Territories (the)" data-icon="fi-tf">French Southern Territories (the)</option>
                                        <option value="Gabon" data-icon="fi-ga">Gabon</option>
                                        <option value="Gambia (the)" data-icon="fi-gm">Gambia (the)</option>
                                        <option value="Georgia" data-icon="fi-ge">Georgia</option>
                                        <option value="Germany" data-icon="fi-de">Germany</option>
                                        <option value="Ghana" data-icon="fi-gh">Ghana</option>
                                        <option value="Gibraltar" data-icon="fi-gi">Gibraltar</option>
                                        <option value="Greece" data-icon="fi-gr">Greece</option>
                                        <option value="Greenland" data-icon="fi-gl">Greenland</option>
                                        <option value="Grenada" data-icon="fi-gd">Grenada</option>
                                        <option value="Guadeloupe" data-icon="fi-gp">Guadeloupe</option>
                                        <option value="Guam" data-icon="fi-gu">Guam</option>
                                        <option value="Guatemala" data-icon="fi-gt">Guatemala</option>
                                        <option value="Guernsey" data-icon="fi-gg">Guernsey</option>
                                        <option value="Guinea" data-icon="fi-gn">Guinea</option>
                                        <option value="Guinea-Bissau" data-icon="fi-gw">Guinea-Bissau</option>
                                        <option value="Guyana" data-icon="fi-gy">Guyana</option>
                                        <option value="Haiti" data-icon="fi-ht">Haiti</option>
                                        <option value="Heard Island and McDonald Islands" data-icon="fi-hm">Heard Island and McDonald Islands</option>
                                        <option value="Holy See (the)" data-icon="fi-va">Holy See (the)</option>
                                        <option value="Honduras" data-icon="fi-hn">Honduras</option>
                                        <option value="Hong Kong" data-icon="fi-hk">Hong Kong</option>
                                        <option value="Hungary" data-icon="fi-hu">Hungary</option>
                                        <option value="Iceland" data-icon="fi-is">Iceland</option>
                                        <option value="India" data-icon="fi-in">India</option>
                                        <option value="Indonesia" data-icon="fi-id">Indonesia</option>
                                        <option value="Iran (Islamic Republic of)" data-icon="fi-ir">Iran (Islamic Republic of)</option>
                                        <option value="Iraq" data-icon="fi-iq">Iraq</option>
                                        <option value="Ireland" data-icon="fi-ie">Ireland</option>
                                        <option value="Isle of Man" data-icon="fi-im">Isle of Man</option>
                                        <option value="Israel" data-icon="fi-il">Israel</option>
                                        <option value="Italy" data-icon="fi-it">Italy</option>
                                        <option value="Jamaica" data-icon="fi-jm">Jamaica</option>
                                        <option value="Japan" data-icon="fi-jp">Japan</option>
                                        <option value="Jersey" data-icon="fi-je">Jersey</option>
                                        <option value="Jordan" data-icon="fi-jo">Jordan</option>
                                        <option value="Kazakhstan" data-icon="fi-kz">Kazakhstan</option>
                                        <option value="Kenya" data-icon="fi-ke">Kenya</option>
                                        <option value="Kiribati" data-icon="fi-ki">Kiribati</option>
                                        <option value="Korea (the Democratic People's Republic of)" data-icon="fi-kp">Korea (the Democratic People's Republic of)</option>
                                        <option value="Korea (the Republic of)" data-icon="fi-kr">Korea (the Republic of)</option>
                                        <option value="Kuwait" data-icon="fi-kw">Kuwait</option>
                                        <option value="Kyrgyzstan" data-icon="fi-kg">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic (the)" data-icon="fi-la">Lao People's Democratic Republic (the)</option>
                                        <option value="Latvia" data-icon="fi-lv">Latvia</option>
                                        <option value="Lebanon" data-icon="fi-lb">Lebanon</option>
                                        <option value="Lesotho" data-icon="fi-ls">Lesotho</option>
                                        <option value="Liberia" data-icon="fi-lr">Liberia</option>
                                        <option value="Libya" data-icon="fi-ly">Libya</option>
                                        <option value="Liechtenstein" data-icon="fi-li">Liechtenstein</option>
                                        <option value="Lithuania" data-icon="fi-lt">Lithuania</option>
                                        <option value="Luxembourg" data-icon="fi-lu">Luxembourg</option>
                                        <option value="Macao" data-icon="fi-mo">Macao</option>
                                        <option value="Madagascar" data-icon="fi-mg">Madagascar</option>
                                        <option value="Malawi" data-icon="fi-mw">Malawi</option>
                                        <option value="Malaysia" data-icon="fi-my" selected="">Malaysia</option>
                                        <option value="Maldives" data-icon="fi-mv">Maldives</option>
                                        <option value="Mali" data-icon="fi-ml">Mali</option>
                                        <option value="Malta" data-icon="fi-mt">Malta</option>
                                        <option value="Marshall Islands (the)" data-icon="fi-mh">Marshall Islands (the)</option>
                                        <option value="Martinique" data-icon="fi-mq">Martinique</option>
                                        <option value="Mauritania" data-icon="fi-mr">Mauritania</option>
                                        <option value="Mauritius" data-icon="fi-mu">Mauritius</option>
                                        <option value="Mayotte" data-icon="fi-yt">Mayotte</option>
                                        <option value="Mexico" data-icon="fi-mx">Mexico</option>
                                        <option value="Micronesia (Federated States of)" data-icon="fi-fm">Micronesia (Federated States of)</option>
                                        <option value="Moldova (the Republic of)" data-icon="fi-md">Moldova (the Republic of)</option>
                                        <option value="Monaco" data-icon="fi-mc">Monaco</option>
                                        <option value="Mongolia" data-icon="fi-mn">Mongolia</option>
                                        <option value="Montenegro" data-icon="fi-me">Montenegro</option>
                                        <option value="Montserrat" data-icon="fi-ms">Montserrat</option>
                                        <option value="Morocco" data-icon="fi-ma">Morocco</option>
                                        <option value="Mozambique" data-icon="fi-mz">Mozambique</option>
                                        <option value="Myanmar" data-icon="fi-mm">Myanmar</option>
                                        <option value="Namibia" data-icon="fi-na">Namibia</option>
                                        <option value="Nauru" data-icon="fi-nr">Nauru</option>
                                        <option value="Nepal" data-icon="fi-np">Nepal</option>
                                        <option value="Netherlands (the)" data-icon="fi-nl">Netherlands (the)</option>
                                        <option value="New Caledonia" data-icon="fi-nc">New Caledonia</option>
                                        <option value="New Zealand" data-icon="fi-nz">New Zealand</option>
                                        <option value="Nicaragua" data-icon="fi-ni">Nicaragua</option>
                                        <option value="Niger (the)" data-icon="fi-ne">Niger (the)</option>
                                        <option value="Nigeria" data-icon="fi-ng">Nigeria</option>
                                        <option value="Niue" data-icon="fi-nu">Niue</option>
                                        <option value="Norfolk Island" data-icon="fi-nf">Norfolk Island</option>
                                        <option value="Northern Mariana Islands (the)" data-icon="fi-mp">Northern Mariana Islands (the)</option>
                                        <option value="Norway" data-icon="fi-no">Norway</option>
                                        <option value="Oman" data-icon="fi-om">Oman</option>
                                        <option value="Pakistan" data-icon="fi-pk">Pakistan</option>
                                        <option value="Palau" data-icon="fi-pw">Palau</option>
                                        <option value="Palestine, State of" data-icon="fi-ps">Palestine, State of</option>
                                        <option value="Panama" data-icon="fi-pa">Panama</option>
                                        <option value="Papua New Guinea" data-icon="fi-pg">Papua New Guinea</option>
                                        <option value="Paraguay" data-icon="fi-py">Paraguay</option>
                                        <option value="Peru" data-icon="fi-pe">Peru</option>
                                        <option value="Philippines (the)" data-icon="fi-ph">Philippines (the)</option>
                                        <option value="Pitcairn" data-icon="fi-pn">Pitcairn</option>
                                        <option value="Poland" data-icon="fi-pl">Poland</option>
                                        <option value="Portugal" data-icon="fi-pt">Portugal</option>
                                        <option value="Puerto Rico" data-icon="fi-pr">Puerto Rico</option>
                                        <option value="Qatar" data-icon="fi-qa">Qatar</option>
                                        <option value="Republic of North Macedonia" data-icon="fi-mk">Republic of North Macedonia</option>
                                        <option value="Romania" data-icon="fi-ro">Romania</option>
                                        <option value="Russian Federation (the)" data-icon="fi-ru">Russian Federation (the)</option>
                                        <option value="Rwanda" data-icon="fi-rw">Rwanda</option>
                                        <option value="Réunion" data-icon="fi-re">Réunion</option>
                                        <option value="Saint Barthélemy" data-icon="fi-bl">Saint Barthélemy</option>
                                        <option value="Saint Helena, Ascension and Tristan da Cunha" data-icon="fi-sh">Saint Helena, Ascension and Tristan da Cunha</option>
                                        <option value="Saint Kitts and Nevis" data-icon="fi-kn">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" data-icon="fi-lc">Saint Lucia</option>
                                        <option value="Saint Martin (French part)" data-icon="fi-mf">Saint Martin (French part)</option>
                                        <option value="Saint Pierre and Miquelon" data-icon="fi-pm">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and the Grenadines" data-icon="fi-vc">Saint Vincent and the Grenadines</option>
                                        <option value="Samoa" data-icon="fi-ws">Samoa</option>
                                        <option value="San Marino" data-icon="fi-sm">San Marino</option>
                                        <option value="Sao Tome and Principe" data-icon="fi-st">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" data-icon="fi-sa">Saudi Arabia</option>
                                        <option value="Senegal" data-icon="fi-sn">Senegal</option>
                                        <option value="Serbia" data-icon="fi-rs">Serbia</option>
                                        <option value="Seychelles" data-icon="fi-sc">Seychelles</option>
                                        <option value="Sierra Leone" data-icon="fi-sl">Sierra Leone</option>
                                        <option value="Singapore" data-icon="fi-sg">Singapore</option>
                                        <option value="Sint Maarten (Dutch part)" data-icon="fi-sx">Sint Maarten (Dutch part)</option>
                                        <option value="Slovakia" data-icon="fi-sk">Slovakia</option>
                                        <option value="Slovenia" data-icon="fi-si">Slovenia</option>
                                        <option value="Solomon Islands" data-icon="fi-sb">Solomon Islands</option>
                                        <option value="Somalia" data-icon="fi-so">Somalia</option>
                                        <option value="South Africa" data-icon="fi-za">South Africa</option>
                                        <option value="South Georgia and the South Sandwich Islands" data-icon="fi-gs">South Georgia and the South Sandwich Islands</option>
                                        <option value="South Sudan" data-icon="fi-ss">South Sudan</option>
                                        <option value="Spain" data-icon="fi-es">Spain</option>
                                        <option value="Sri Lanka" data-icon="fi-lk">Sri Lanka</option>
                                        <option value="Sudan (the)" data-icon="fi-sd">Sudan (the)</option>
                                        <option value="Suriname" data-icon="fi-sr">Suriname</option>
                                        <option value="Svalbard and Jan Mayen" data-icon="fi-sj">Svalbard and Jan Mayen</option>
                                        <option value="Sweden" data-icon="fi-se">Sweden</option>
                                        <option value="Switzerland" data-icon="fi-ch">Switzerland</option>
                                        <option value="Syrian Arab Republic" data-icon="fi-sy">Syrian Arab Republic</option>
                                        <option value="Taiwan (Province of China)" data-icon="fi-tw">Taiwan (Province of China)</option>
                                        <option value="Tajikistan" data-icon="fi-tj">Tajikistan</option>
                                        <option value="Tanzania, United Republic of" data-icon="fi-tz">Tanzania, United Republic of</option>
                                        <option value="Thailand" data-icon="fi-th">Thailand</option>
                                        <option value="Timor-Leste" data-icon="fi-tl">Timor-Leste</option>
                                        <option value="Togo" data-icon="fi-tg">Togo</option>
                                        <option value="Tokelau" data-icon="fi-tk">Tokelau</option>
                                        <option value="Tonga" data-icon="fi-to">Tonga</option>
                                        <option value="Trinidad and Tobago" data-icon="fi-tt">Trinidad and Tobago</option>
                                        <option value="Tunisia" data-icon="fi-tn">Tunisia</option>
                                        <option value="Turkey" data-icon="fi-tr">Turkey</option>
                                        <option value="Turkmenistan" data-icon="fi-tm">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands (the)" data-icon="fi-tc">Turks and Caicos Islands (the)</option>
                                        <option value="Tuvalu" data-icon="fi-tv">Tuvalu</option>
                                        <option value="Uganda" data-icon="fi-ug">Uganda</option>
                                        <option value="Ukraine" data-icon="fi-ua">Ukraine</option>
                                        <option value="United Arab Emirates (the)" data-icon="fi-ae">United Arab Emirates (the)</option>
                                        <option value="United Kingdom of Great Britain and Northern Ireland (the)" data-icon="fi-gb">United Kingdom of Great Britain and Northern Ireland (the)</option>
                                        <option value="United States Minor Outlying Islands (the)" data-icon="fi-um">United States Minor Outlying Islands (the)</option>
                                        <option value="United States of America (the)" data-icon="fi-us">United States of America (the)</option>
                                        <option value="Uruguay" data-icon="fi-uy">Uruguay</option>
                                        <option value="Uzbekistan" data-icon="fi-uz">Uzbekistan</option>
                                        <option value="Vanuatu" data-icon="fi-vu">Vanuatu</option>
                                        <option value="Venezuela (Bolivarian Republic of)" data-icon="fi-ve">Venezuela (Bolivarian Republic of)</option>
                                        <option value="Viet Nam" data-icon="fi-vn">Viet Nam</option>
                                        <option value="Virgin Islands (British)" data-icon="fi-vg">Virgin Islands (British)</option>
                                        <option value="Virgin Islands (U.S.)" data-icon="fi-vi">Virgin Islands (U.S.)</option>
                                        <option value="Wallis and Futuna" data-icon="fi-wf">Wallis and Futuna</option>
                                        <option value="Western Sahara" data-icon="fi-eh">Western Sahara</option>
                                        <option value="Yemen" data-icon="fi-ye">Yemen</option>
                                        <option value="Zambia" data-icon="fi-zm">Zambia</option>
                                        <option value="Zimbabwe" data-icon="fi-zw">Zimbabwe</option>
                                        <option value="Åland Islands" data-icon="fi-ax">Åland Islands</option>
                                    </select><span class="select2 select2-container select2-container--default" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-waef-container"><span class="select2-selection__rendered" id="select2-waef-container" title="Malaysia"><span><i class="fi fi-my"></i> Malaysia</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                </div>
                                <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                                    <div class="input-group mobile-design-change bootstrap-touchspin">
                                        <span class="touchspin-value">10</span>
                                        <input class="form-control" type="text" placeholder="Weight" style="display: block;" data-bs-original-title="" title="">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                                    <div class="d-flex justify-content-end align-items-center cus-justify-content-center">
                                        <div class="d-block cursor-pointer custom-input-design w-100">
                                            <input class="checkbox_animated custom-input" id="edo-ani-2" type="radio" name="rdo-ani" checked="" data-bs-original-title="" title="">
                                            <label for="edo-ani-2" class="custom-input-label w-100">PCS</label>
                                        </div>
                                        <div class="d-block cursor-pointer custom-input-design w-100">
                                            <input class="checkbox_animated custom-input" id="edo-ani1-2" type="radio" name="rdo-ani" data-bs-original-title="" title="">
                                            <label for="edo-ani1-2" class="custom-input-label reverse w-100">gram</label>
                                        </div>
                                    </div>
                                </div>

                                <div class=" col-xxl-4 col-xl-6 col-md-6 col-6 mb-3 field-area">
                                    <div class="input-group mobile-design-change bootstrap-touchspin">
                                        <span class="touchspin-value"> 10 </span>
                                        <input class="form-control" type="text" placeholder="Product" data-bs-original-title="" title="">
                                        <span class="input-group-text bootstrap-touchspin-postfix" style="display: none;"></span>
                                        <button class="btn btn-primary btn-square bootstrap-touchspin-down touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-square bootstrap-touchspin-up touchspin-btn" type="button" data-bs-original-title="" title=""><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-6 mb-3 d-flex  field-area">
                                    <div class=" offer-price-checkbox text-nowrap">
                                        <div>
                                            <input type="checkbox" id="offer-price-id" name="" data-bs-original-title="" title="">
                                            <label for="offer-price-id" style="font-size: 12px; color: #898989">Offer Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-4 col-xl-12 col-md-12 mb-3">
                                    <div class="input-group d-flex custom-select-file-wrap">
                                        <input type="file" class="form-control" id="select-file" data-bs-original-title="" title="">
                                        <label for="select-file" class="custom-select-file"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload-cloud">
                                                <polyline points="16 16 12 12 8 16"></polyline>
                                                <line x1="12" y1="12" x2="12" y2="21"></line>
                                                <path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"></path>
                                                <polyline points="16 16 12 12 8 16"></polyline>
                                            </svg> <span>Upload a file</span></label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-align-right text-sm-end">
                        <button class="btn" data-bs-original-title="" title="">Cancel</button>
                        <button class="btn btn-primary" data-bs-original-title="" title="">Add Product</button>
                    </div>
                </div>
            </div>
            <!-- new product form end -->

        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection
