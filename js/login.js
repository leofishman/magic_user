(function ($, Drupal,  window, document) {
    'use strict';

    Drupal.behaviors.magic_user = {
        attach: async function (context, drupalSettings) {
          let apikeypublic = drupalSettings.apikeypublic;
          let network = drupalSettings.network;

          $('#magic-script').click(function (event) {
              event.preventDefault()
               const connectWIthUi = async () => {
                try {
                  var magic = new Magic(apikeypublic, {
                    network: network
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
            let promiEvent;
            promiEvent = connectWIthUi()

            console.log(promiEvent);
            });
        }
    };
}(jQuery, Drupal, this, this.document));
