(function ($, Drupal, window, document) {
    'use strict';
    // TODO get apikey from settings
    const apikey = 'pk_live_C239FDA89ABAF3AF'
    Drupal.behaviors.Mlogin = {
        attach: async function (context, settings) {
            $('#magic-script').click(function (event) {
               event.preventDefault()
               const connectWIthUi = async () => {
                try {
                  var magic = new Magic(apikey, {
                    network: "goerli"
                  });
                  const provider = await magic.wallet.getProvider();
                  const web3 = new Web3(provider);
                  const accounts = await magic.wallet.connectWithUI();

                  // TODO get public address from magic and negotiate a did_token

                 await magic.preload().then(() => console.log('Magic <iframe> loaded.'));

                }
                catch (e){
                  console.error(e)
                }
              }
              connectWIthUi()
            });
        }
    };
}(jQuery, Drupal, this, this.document));
