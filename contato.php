<?php
/**
 * Template Name: Página Contato Blog AqGoEs
 * * @package Blog_AqGoEs
 */

get_header(); 
?>

<main id="primary" class="site-main content-area">

  <section class="page-hero">
    <div class="container">
      <span class="hero__tag">✉️ <?php _e('Fale conosco', 'aqgoes'); ?></span>
      <h1><?php printf( __( 'Entre em %sContato%s', 'aqgoes' ), '<em>', '</em>' ); ?></h1>
      <p><?php _e('Dúvidas, sugestões, parcerias ou só um alô? Estamos aqui.', 'aqgoes'); ?></p>
    </div>
  </section>

  <section class="contact section-pad">
    <div class="container contact__grid">

      <div class="contact__form-wrapper">
        <h2><?php _e('Envie uma mensagem', 'aqgoes'); ?></h2>

        <form class="contact__form" id="contactForm" novalidate method="POST">
          
          <?php 
          // PASSO 1: Injeção de Nonce para segurança do formulário (Proteção contra CSRF)
          wp_nonce_field( 'aqgoes_contact_form_action', 'aqgoes_contact_form_nonce' ); 
          ?>

          <div class="form__group" id="groupNome">
            <label for="nome" class="form__label">
              <?php _e('Nome completo', 'aqgoes'); ?> <span class="form__required" aria-hidden="true">*</span>
            </label>
            <input
              type="text"
              id="nome"
              name="nome"
              class="form__input"
              placeholder="<?php esc_attr_e('Seu nome', 'aqgoes'); ?>"
              autocomplete="name"
              required
              aria-describedby="nomeError"
              aria-invalid="false"
            />
            <span class="form__error" id="nomeError" role="alert"></span>
          </div>

          <div class="form__group" id="groupEmail">
            <label for="email" class="form__label">
              <?php _e('E-mail', 'aqgoes'); ?> <span class="form__required" aria-hidden="true">*</span>
            </label>
            <input
              type="email"
              id="email"
              name="email"
              class="form__input"
              placeholder="seu@email.com"
              autocomplete="email"
              required
              aria-describedby="emailError"
              aria-invalid="false"
            />
            <span class="form__error" id="emailError" role="alert"></span>
          </div>

          <div class="form__group" id="groupAssunto">
            <label for="assunto" class="form__label">
              <?php _e('Assunto', 'aqgoes'); ?> <span class="form__required" aria-hidden="true">*</span>
            </label>
            <select
              id="assunto"
              name="assunto"
              class="form__input form__select"
              required
              aria-describedby="assuntoError"
              aria-invalid="false"
            >
              <option value=""><?php _e('Selecione um assunto...', 'aqgoes'); ?></option>
              <option value="duvida"><?php _e('Dúvida técnica', 'aqgoes'); ?></option>
              <option value="sugestao"><?php _e('Sugestão de conteúdo', 'aqgoes'); ?></option>
              <option value="parceria"><?php _e('Parceria / Colaboração', 'aqgoes'); ?></option>
              <option value="erro"><?php _e('Reportar erro', 'aqgoes'); ?></option>
              <option value="outro"><?php _e('Outro', 'aqgoes'); ?></option>
            </select>
            <span class="form__error" id="assuntoError" role="alert"></span>
          </div>

          <div class="form__group" id="groupMensagem">
            <label for="mensagem" class="form__label">
              <?php _e('Mensagem', 'aqgoes'); ?> <span class="form__required" aria-hidden="true">*</span>
            </label>
            <textarea
              id="mensagem"
              name="mensagem"
              class="form__input form__textarea"
              placeholder="<?php esc_attr_e('Escreva sua mensagem aqui...', 'aqgoes'); ?>"
              rows="5"
              required
              minlength="20"
              aria-describedby="mensagemError mensagemCount"
              aria-invalid="false"
            ></textarea>
            <div class="form__textarea-footer">
              <span class="form__error" id="mensagemError" role="alert"></span>
              <span class="form__char-count" id="mensagemCount">0 / 500 <?php _e('caracteres', 'aqgoes'); ?></span>
            </div>
          </div>

          <div class="form__group form__honeypot" aria-hidden="true">
            <label for="website"><?php _e('Website (não preencha)', 'aqgoes'); ?></label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" />
          </div>

          <button type="submit" class="btn btn--primary btn--full" id="submitBtn">
            <span class="btn__text"><?php _e('Enviar mensagem', 'aqgoes'); ?></span>
            <span class="btn__loading hidden"><?php _e('Enviando...', 'aqgoes'); ?></span>
          </button>

        </form>

        <div class="form__success hidden" id="formSuccess" role="alert" aria-live="assertive">
          <div class="success__icon">✅</div>
          <h3><?php _e('Mensagem enviada!', 'aqgoes'); ?></h3>
          <p><?php _e('Recebemos seu contato e responderemos em até 48 horas. Obrigado!', 'aqgoes'); ?></p>
          <button class="btn btn--ghost" id="newMessageBtn"><?php _e('Enviar outra mensagem', 'aqgoes'); ?></button>
        </div>
      </div>

      <aside class="contact__info">
        <h2><?php _e('Outras formas de falar com a gente', 'aqgoes'); ?></h2>

        <div class="contact__info-list">

          <div class="contact__info-item">
            <div class="contact__info-icon">📧</div>
            <div>
              <strong><?php _e('E-mail', 'aqgoes'); ?></strong>
              <p><?php echo antispambot( get_bloginfo('admin_email') ); ?></p> 
            </div>
          </div>

          <div class="contact__info-item">
            <div class="contact__info-icon">💬</div>
            <div>
              <strong><?php _e('Discord', 'aqgoes'); ?></strong>
              <p>discord.gg/aqgoes</p>
            </div>
          </div>

          <div class="contact__info-item">
            <div class="contact__info-icon">🐙</div>
            <div>
              <strong><?php _e('GitHub', 'aqgoes'); ?></strong>
              <p>github.com/alanqueiros</p>
            </div>
          </div>

          <div class="contact__info-item">
            <div class="contact__info-icon">⏰</div>
            <div>
              <strong><?php _e('Tempo de resposta', 'aqgoes'); ?></strong>
              <p><?php _e('Geralmente dentro de 48 horas úteis', 'aqgoes'); ?></p>
            </div>
          </div>

        </div>

        <div class="contact__faq">
          <h3><?php _e('Perguntas frequentes', 'aqgoes'); ?></h3>

          <details class="faq__item">
            <summary><?php _e('Posso sugerir um tema de artigo?', 'aqgoes'); ?></summary>
            <p><?php _e('Sim! Use o formulário e selecione "Sugestão de conteúdo". Adoramos receber ideias da comunidade.', 'aqgoes'); ?></p>
          </details>

          <details class="faq__item">
            <summary><?php _e('Como me tornar autor?', 'aqgoes'); ?></summary>
            <p><?php _e('Entre em contato via e-mail com alguns exemplos do seu trabalho. Analisamos todas as propostas.', 'aqgoes'); ?></p>
          </details>

          <details class="faq__item">
            <summary><?php _e('O conteúdo é sempre gratuito?', 'aqgoes'); ?></summary>
            <p><?php _e('Sim! Todo o conteúdo do AqGoEs é gratuito e sempre será. Somos sustentados pela comunidade.', 'aqgoes'); ?></p>
          </details>
        </div>

      </aside>

    </div>
  </section>

</main>

<?php get_footer(); ?>