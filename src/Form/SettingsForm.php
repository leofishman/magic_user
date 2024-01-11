<?php

namespace Drupal\magic_user\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Magic User settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'magic_user_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['magic_user.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['login_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Login Text'),
      '#default_value' => $this->config('magic_user.settings')->get('login_text'),
    ];

    $form['apikeypublic'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Publishable Api Key'),
      '#default_value' => $this->config('magic_user.settings')->get('apikeypublic'),
      '#required' => TRUE,
    ];

    $form['apikeysecret'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Secret Key'),
      '#default_value' => $this->config('magic_user.settings')->get('apikeysecret'),
      '#required' => TRUE,
    ];

    $options = [
      'ethereum' => $this->t('Ethereum (Mainnet)'),
      'ethereum-goerly' => $this->t('Ethereum (Testnet)'),
      'polygon' => $this->t('Polygon (Mainnet)'),
      'polygon-mumbai' => $this->t('Ethereum (Testnet)'),
      'solana-mainnet' => $this->t('Solana (Mainnet)'),
      'solana-testnet' => $this->t('Solana (Testnet)'),
    ];

    $form['network'] = [
      '#type' => 'select',
      '#options' => $options,
      '#title' => $this->t('Network'),
      '#default_value' => $this->config('magic_user.settings')->get('network'),
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('magic_user.settings')
      ->set('login_text', $form_state->getValue('login_text'))
      ->set('apikeysecret', $form_state->getValue('apikeysecret'))
      ->set('apikeypublic', $form_state->getValue('apikeypublic'))
      ->set('network', $form_state->getValue('network'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
