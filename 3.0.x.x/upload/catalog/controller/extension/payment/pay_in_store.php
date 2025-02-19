<?php
class ControllerExtensionPaymentPayInStore extends Controller {
	public function index() {
		$this->load->language('extension/payment/pay_in_store');

		$data['pay_in_store'] = nl2br($this->config->get('payment_pay_in_store_pay_in_store' . $this->config->get('config_language_id')));

		$data['continue'] = $this->url->link('checkout/success');

		return $this->load->view('extension/payment/pay_in_store', $data);
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'pay_in_store') {
			$this->load->language('extension/payment/pay_in_store');

			$this->load->model('checkout/order');

			$comment  = $this->language->get('text_instruction') . "\n\n";
			$comment .= $this->config->get('payment_pay_in_store_pay_in_store' . $this->config->get('config_language_id')) . "\n\n";
			$comment .= $this->language->get('text_payment');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('payment_pay_in_store_order_status_id'), $comment, true);
		}
	}
}