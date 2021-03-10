import HttpClient from 'src/service/http-client.service';
import Plugin from 'src/plugin-system/plugin.class';

export default class SetDataTransferPlugin extends Plugin {
    init() {
        const httpClient = new HttpClient(window.accessKey, window.contextToken);
        Array.prototype.forEach.call(
            document.getElementsByClassName('checkout-confirm-transfer-radio'),
            function (element) {
                // Validation of the required attribute doesn't work without this
                element.checked = true;
                element.checked = false;
                element.addEventListener('change', function () {
                    httpClient.post(
                        '/shirtcharity/checkout/data-transfer',
                        JSON.stringify({
                            _csrf_token: this.getAttribute('data-csrf-token'),
                            dataTransferAccepted: this.value === 'yes'
                        })
                    );
                });
            }
        );
    }
}
