
  <div id="produits-fenplast" class="l-section m-contact">
    <div class="l-wrapper">


      <h3><?= _( 'Contactez Nous' ); ?></h3>

      <div class="row">
        <div class="col-pad-06">

          <form id="contact" class="m-contact-form" method="post" action="?" autocomplete="off">
              <div>
                  <fieldset>


                      <!-- <div id="js-form-output" class="m-form-output"></div> -->

                      <fieldset>
                          <div class="row">
                              <div class="col-pad-12">

                                  <select class="m-field" name="opt_reason" id="f-contact-reason" required>
                                      <option disabled selected><?= _(" -- choisir une option -- "); ?></option>
                                      <option <?= _("value=\"Demande de renseignements\""); ?>><?= _('Demande de renseignements'); ?></option>
                                  </select>

                                  <input class="m-field" name="txt_phone" id="f-contact-phone" type="tel" placeholder="Telephone" required/>

                                  <textarea class="m-field-text" name="txt_contact" id="f-contact-text" rows="20" maxlength="500" placeholder="Votre Message..." required ></textarea>

                              <div class="m-captcha-wrapper">
                                  <div id="captcha"></div>
                              </div>

                              </div>
                          </div> <!-- .row END -->
                      </fieldset>


                      <div class="m-submit-button">
                          <button class="button" type="submit" value="submit" id="f-contact-submit" name="submit"><?= _("Soumettre"); ?></button>
                      </div>

                  </fieldset>
              </div>
          </form>
        </div>

        <div class="col-pad-06">
          <div class="m-contact-img">
            <img src="http://placehold.it/500x500/ee343f/002543.jpg?text=Photo">
          </div>
        </div>
      </div>



    </div>
  </div>
