<?php
if (isset($block['data']['preview_image'])): ?>
   <img src="<?php echo esc_url($block['data']['preview_image']); ?>" style="width: 100%; height: auto;">
<?php
   return;
endif;

$container = get_field('container');

$classes = [
   'pt-150',
   'pb-80',
   'section-cta-block',
];
//print_r($container);
if (!empty($container['settings']['show_in_front_end'])):
   echo Hdltheme_Builder::section_start($container['settings'], $classes);
?>
   <?php if (have_rows('container')): ?>
      <?php while (have_rows('container')): the_row();
      ?>
         <div class="container">
            <div class="row pb-100">
               <div class="col-xl-6 col-lg-8 m-auto">

                  <div class="text-container text-center extra-pd-sm">
                     <h2>Nyheter / Blogg / Artiklar</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-lg-12">
                  <div class="filter-block blog-filter-block">
                     <div class="left-block">
                        <input type="text" class="form-control" placeholder="Sök bland nyheter…">

                        <select class="form-control custom-select select2-hidden-accessible" data-select2-id="select2-data-1-jnxy" tabindex="-1" aria-hidden="true">
                           <option value="" disabled="" selected="" data-select2-id="select2-data-3-pkxl">Välj ämne</option>
                           <option value="">1</option>
                           <option value="">2</option>
                           <option value="">3</option>
                        </select><span class="select2 select2-container select2-container--default" dir="ltr" data-select2-id="select2-data-2-vs8x" style="width: 233.1px;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-sjzv-container" aria-controls="select2-sjzv-container"><span class="select2-selection__rendered" id="select2-sjzv-container" role="textbox" aria-readonly="true" title="Välj ämne">Välj ämne</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                     </div>
                     <div class="right-block">
                        <ul class="list-unstyled filter-btns text-right">
                           <li><a href="#" class="active">Alla</a></li>
                           <li><a href="#">Privat</a></li>
                           <li><a href="#">Företag</a></li>
                        </ul>
                     </div>
                  </div>

                  <div class="filter-result extra-pd-sm mt-35">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="single-result img-text-block">
                              <div class="single-block horizontal">
                                 <div class="row no-gutters row-gap-0">
                                    <div class="col-md-6">
                                       <div class="img-container">
                                          <img src="images/belysning-natt.png" alt="">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="text-container">
                                          <div class="date">Publicerad 01 01 2026</div>
                                          <h4>Lorem ipsum dolor</h4>
                                          <p>Pingday är mer än bara fiber. Vi är med och skapar det digitala
                                             Helsingborg, från det öppna stadsnätet och IoT-lösningar till
                                             operatörshotell och aktiva partnerskap med kommuner som Höganäs och
                                             Bjuv. Vi driver också Helsingborgs digitaliseringsresa framåt genom
                                             att hela tiden vara i framkant när det gäller teknik och samarbete.
                                          </p>

                                          <div class="btn-wrapper mt-25">
                                             <a href="#" class="text-link">Läs mer
                                             </a>
                                          </div>

                                          <div class="badge-wrapper mt-25">
                                             <div class="single-badge">Ämne 1</div>
                                             <div class="single-badge">Ämne 2</div>
                                             <div class="single-badge">Ämne 3</div>
                                          </div>


                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="single-result img-text-block">
                              <div class="single-block vertical">
                                 <div class="row no-gutters row-gap-0">
                                    <div class="col-md-12">
                                       <div class="img-container">
                                          <img src="images/belysning-natt.png" alt="">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="text-container">
                                          <div class="date">Publicerad 01 01 2026</div>
                                          <h4>Lorem ipsum dolor</h4>
                                          <p>Vi går mot en framtid där fler individer med behov av vård och omsorg
                                             behöver tas hand om av färre. Sensorer som känner av rörelse…
                                          </p>

                                          <div class="btn-wrapper mt-10">
                                             <a href="#" class="text-link">Läs mer
                                             </a>
                                          </div>

                                          <div class="badge-wrapper mt-25">
                                             <div class="single-badge">Ämne 1</div>
                                             <div class="single-badge">Ämne 2</div>
                                             <div class="single-badge">Ämne 3</div>
                                          </div>


                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="single-result img-text-block">
                              <div class="single-block vertical">
                                 <div class="row no-gutters row-gap-0">
                                    <div class="col-md-12">
                                       <div class="img-container">
                                          <img src="images/belysning-natt.png" alt="">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="text-container">
                                          <div class="date">Publicerad 01 01 2026</div>
                                          <h4>Lorem ipsum dolor</h4>
                                          <p>Vi går mot en framtid där fler individer med behov av vård och omsorg
                                             behöver tas hand om av färre. Sensorer som känner av rörelse…
                                          </p>

                                          <div class="btn-wrapper mt-10">
                                             <a href="#" class="text-link">Läs mer
                                             </a>
                                          </div>

                                          <div class="badge-wrapper mt-25">
                                             <div class="single-badge">Ämne 1</div>
                                             <div class="single-badge">Ämne 2</div>
                                             <div class="single-badge">Ämne 3</div>
                                          </div>


                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="single-result img-text-block">
                              <div class="single-block vertical">
                                 <div class="row no-gutters row-gap-0">
                                    <div class="col-md-12">
                                       <div class="img-container">
                                          <img src="images/belysning-natt.png" alt="">
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="text-container">
                                          <div class="date">Publicerad 01 01 2026</div>
                                          <h4>Lorem ipsum dolor</h4>
                                          <p>Vi går mot en framtid där fler individer med behov av vård och omsorg
                                             behöver tas hand om av färre. Sensorer som känner av rörelse…
                                          </p>

                                          <div class="btn-wrapper mt-10">
                                             <a href="#" class="text-link">Läs mer
                                             </a>
                                          </div>

                                          <div class="badge-wrapper mt-25">
                                             <div class="single-badge">Ämne 1</div>
                                             <div class="single-badge">Ämne 2</div>
                                             <div class="single-badge">Ämne 3</div>
                                          </div>


                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="pagination-and-text-block text-center mt-60">
                        <div class="text-container">
                           <p>Visar 8 / 123 Nyhetsinlägg <br>
                              lorem ipsum dolor</p>
                        </div>

                        <div class="pagination-block mt-35">
                           <ul class="nav-pages">
                              <li class="li-nav-arrows"><a href="#" title=""><span class="icon-left-arrow"></span></a>
                              </li>
                              <li><a href="#" title="">1</a></li>
                              <li class="active"><a href="#" title="">2</a></li>
                              <li><a href="#" title="">...</a></li>
                              <li><a href="#" title="">16</a></li>
                              <li class="li-nav-arrows"><a href="#" title=""><span class="icon-right-arrow"></span></a></li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        
      <?php endwhile; ?>
   <?php endif; ?>
   <?php echo Hdltheme_Builder::section_end(); ?>
<?php endif; ?>