<?php

class ControllerPaymentPayfortStart extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('payment/payfort_start');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('payfort_start', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_edit'] = $this->language->get('text_edit');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_all_zones'] = $this->language->get('text_all_zones');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_authorization_capture'] = $this->language->get('text_authorization_capture');
        $this->data['text_authorization_only'] = $this->language->get('text_authorization_only');

        $this->data['entry_live_open_key'] = $this->language->get('entry_live_open_key');
        $this->data['entry_live_secret_key'] = $this->language->get('entry_live_secret_key');
        $this->data['entry_test_open_key'] = $this->language->get('entry_test_open_key');
        $this->data['entry_test_secret_key'] = $this->language->get('entry_test_secret_key');

        $this->data['entry_test'] = $this->language->get('entry_test');
        $this->data['entry_transaction'] = $this->language->get('entry_transaction');
        $this->data['entry_total'] = $this->language->get('entry_total');
        $this->data['entry_order_status'] = $this->language->get('entry_order_status');
        $this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['help_test'] = $this->language->get('help_test');
        $this->data['help_total'] = $this->language->get('help_total');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');


        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['payfort_start_entry_live_open_key'])) {
            $this->data['error_payfort_start_entry_live_open_key'] = $this->error['payfort_start_entry_live_open_key'];
        } else {
            $this->data['error_payfort_start_entry_live_open_key'] = '';
        }
 
         if (isset($this->error['payfort_start_entry_live_secret_key'])) {
            $this->data['error_payfort_start_entry_live_secret_key'] = $this->error['payfort_start_entry_live_secret_key'];
        } else {
            $this->data['error_payfort_start_entry_live_secret_key'] = '';
        }
        
         if (isset($this->error['payfort_start_entry_test_open_key'])) {
            $this->data['error_payfort_start_entry_test_open_key'] = $this->error['payfort_start_entry_test_open_key'];
        } else {
            $this->data['error_payfort_start_entry_test_open_key'] = '';
        }
        
         if (isset($this->error['payfort_start_entry_test_secret_key'])) {
            $this->data['error_payfort_start_entry_test_secret_key'] = $this->error['payfort_start_entry_test_secret_key'];
        } else {
            $this->data['error_payfort_start_entry_test_secret_key'] = '';
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/payfort_start', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('payment/payfort_start', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

        if (isset($this->request->post['payfort_start_entry_live_open_key'])) {
            $this->data['payfort_start_entry_live_open_key'] = $this->request->post['payfort_start_entry_live_open_key'];
        } else {
            $this->data['payfort_start_entry_live_open_key'] = $this->config->get('payfort_start_entry_live_open_key');
        }

        if (isset($this->request->post['payfort_start_entry_live_secret_key'])) {
            $this->data['payfort_start_entry_live_secret_key'] = $this->request->post['payfort_start_entry_live_secret_key'];
        } else {
            $this->data['payfort_start_entry_live_secret_key'] = $this->config->get('payfort_start_entry_live_secret_key');
        }
        if (isset($this->request->post['payfort_start_entry_test_open_key'])) {
            $this->data['payfort_start_entry_test_open_key'] = $this->request->post['payfort_start_entry_test_open_key'];
        } else {
            $this->data['payfort_start_entry_test_open_key'] = $this->config->get('payfort_start_entry_test_open_key');
        }

        if (isset($this->request->post['payfort_start_entry_test_secret_key'])) {
            $this->data['payfort_start_entry_test_secret_key'] = $this->request->post['payfort_start_entry_test_secret_key'];
        } else {
            $this->data['payfort_start_entry_test_secret_key'] = $this->config->get('payfort_start_entry_test_secret_key');
        }

        if (isset($this->request->post['payfort_start_test'])) {
            $this->data['payfort_start_test'] = $this->request->post['payfort_start_test'];
        } else {
            $this->data['payfort_start_test'] = $this->config->get('payfort_start_test');
        }

        if (isset($this->request->post['payfort_start_method'])) {
            $this->data['payfort_start_transaction'] = $this->request->post['payfort_start_transaction'];
        } else {
            $this->data['payfort_start_transaction'] = $this->config->get('payfort_start_transaction');
        }

        if (isset($this->request->post['payfort_start_total'])) {
            $this->data['payfort_start_total'] = $this->request->post['payfort_start_total'];
        } else {
            $this->data['payfort_start_total'] = $this->config->get('payfort_start_total');
        }

        if (isset($this->request->post['payfort_start_order_status_id'])) {
            $this->data['payfort_start_order_status_id'] = $this->request->post['payfort_start_order_status_id'];
        } else {
            $this->data['payfort_start_order_status_id'] = $this->config->get('payfort_start_order_status_id');
        }

        $this->load->model('localisation/order_status');

        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

        if (isset($this->request->post['payfort_start_geo_zone_id'])) {
            $this->data['payfort_start_geo_zone_id'] = $this->request->post['payfort_start_geo_zone_id'];
        } else {
            $this->data['payfort_start_geo_zone_id'] = $this->config->get('payfort_start_geo_zone_id');
        }

        $this->load->model('localisation/geo_zone');

        $this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        if (isset($this->request->post['payfort_start_status'])) {
            $this->data['payfort_start_status'] = $this->request->post['payfort_start_status'];
        } else {
            $this->data['payfort_start_status'] = $this->config->get('payfort_start_status');
        }

        if (isset($this->request->post['payfort_start_sort_order'])) {
            $this->data['payfort_start_sort_order'] = $this->request->post['payfort_start_sort_order'];
        } else {
            $this->data['payfort_start_sort_order'] = $this->config->get('payfort_start_sort_order');
        }

        $this->template = 'payment/payfort_start.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'payment/payfort_start')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

?>
