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
      ->set('apikeysecret', $form_state->getValue('apikeysecret'))
      ->set('apikeypublic', $form_state->getValue('apikeypublic'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
