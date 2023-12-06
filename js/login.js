(function ($, Drupal,  window, document) {
    'use strict';

    Drupal.behaviors.Mlogin = {
        attach: async function (context, drupalSettings) {
          let apikeypublic = drupalSettings.apikeypublic;
          $('#magic-script').click(function (event) {
              event.preventDefault()
              //TODO get from configuration which provider and login method to use
               const connectWIthUi = async () => {
                try {
                  var magic = new Magic(apikeypublic, {
                    network: "goerli"
                  });
                  const provider = await magic.wallet.getProvider();
                  const web3 = new Web3(provider);
                  const accounts = await magic.wallet.connectWithUI();

                  if (accounts.length > 0) {
                    console.log(accounts, 11221, accounts.length)
                    const did_token = await get_did_token(accounts, magic);
                    console.log(33,did_token)

                  }

                  // TODO get public address from magic and negotiate a did_token

                 await magic.preload().then((publicAddress) => console.log(accounts, 2222, 'Magic <iframe> loaded.', publicAddress));

                }
                catch (e){
                  console.error(e)
                }
              }
              connectWIthUi()
            });

            async function get_did_token(accounts, magic) {

              const lifespan = 3600 * 24; // 1 day
              const subject = "did:ethr:0x1234567890123456789"
              const audience = "https://example.com";
              // Construct the user's claim
              const claim = JSON.stringify({
                iat: Math.floor(Date.now() / 1000),
                ext: Math.floor(Date.now() / 1000) + lifespan,
                iss: `did:ethr:${accounts[0]}`,
                sub: subject,
                aud: audience,
                nbf: Math.floor(Date.now() / 1000),
                tid: uuid(),
              });

              // Sign the claim with the user's private key
              // (this way the claim is verifiable and impossible to forge).
              const proof = sign(claim);

              // Encode the DIDToken so it can be transported over HTTP.
              const DIDToken = btoa(JSON.stringify([proof, claim]));
              // const didToken = magic.utils.jwt.getJwt();
              // const publicAddress = await magic.utils.getAddress(accounts[0]);
              // const token = magic.token.get();
              return {
                DIDToken
              };
            }

            function uuid() {

              // Generate a random UUID
              const random_uuid = uuidv4();

              // Print the UUID
              console.log(random_uuid);

              function uuidv4() {
                  return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'
                  .replace(/[xy]/g, function (c) {
                      const r = Math.random() * 16 | 0,
                          v = c == 'x' ? r : (r & 0x3 | 0x8);
                      return v.toString(16);
                  });
              }
              return random_uuid;
            }

        }
    };
}(jQuery, Drupal, this, this.document));
