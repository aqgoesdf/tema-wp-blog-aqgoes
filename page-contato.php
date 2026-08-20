<?php
/**
 * Template Name: Contato
 *
 * page-contato.php — aplicado automaticamente na Página com slug "contato".
 * Processa o formulário via wp_mail(), com nonce + honeypot anti-spam.
 *
 * @package aqgoes
 */

$aqgoes_sent  = false;
$aqgoes_error = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['aqgoes_contact_nonce'] ) ) {
	if ( ! wp_verify_nonce( $_POST['aqgoes_contact_nonce'], 'aqgoes_contact_form' ) ) {
		$aqgoes_error = 'Sessão expirada, tenta de novo.';
	} elseif ( ! empty( $_POST['aqgoes_website'] ) ) {
		// honeypot preenchido = bot. Finge sucesso, não envia nada.
		$aqgoes_sent = true;
	} else {
		$name    = isset( $_POST['aqgoes_name'] ) ? sanitize_text_field( wp_unslash( $_POST['aqgoes_name'] ) ) : '';
		$email   = isset( $_POST['aqgoes_email'] ) ? sanitize_email( wp_unslash( $_POST['aqgoes_email'] ) ) : '';
		$subject = isset( $_POST['aqgoes_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['aqgoes_subject'] ) ) : '';
		$message = isset( $_POST['aqgoes_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['aqgoes_message'] ) ) : '';

		if ( ! $name || ! is_email( $email ) || ! $message ) {
			$aqgoes_error = 'Preenche nome, e-mail válido e mensagem.';
		} else {
			$to      = get_option( 'admin_email' );
			$title   = sprintf( '[%s] Contato: %s', get_bloginfo( 'name' ), $subject ? $subject : 'Sem assunto' );
			$body    = "Nome: {$name}\nE-mail: {$email}\n\nMensagem:\n{$message}";
			$headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );

			$aqgoes_sent = wp_mail( $to, $title, $body, $headers );
			if ( ! $aqgoes_sent ) {
				$aqgoes_error = 'Não consegui enviar agora. Tenta de novo em instantes.';
			}
		}
	}
}

get_header();
?>

<main class="flex-grow pt-28 pb-16">
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

    <header class="mb-12 text-center sm:text-left border-b border-subtle pb-8">
      <span class="px-3 py-1.5 rounded-md text-xs font-bold bg-brand/10 text-brand border border-brand/20 uppercase tracking-wider font-mono inline-block mb-3">
        Vamos conversar
      </span>
      <h1 class="font-title text-3xl sm:text-5xl font-extrabold tracking-tight text-primary leading-tight">
        <?php the_title(); ?>
      </h1>
      <p class="text-muted text-base mt-3 max-w-lg">
        Dúvida, sugestão de assunto pro blog, ou só quer trocar uma ideia sobre dev — manda a mensagem.
      </p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

      <!-- Formulário -->
      <div class="lg:col-span-7">
        <?php if ( $aqgoes_sent ) : ?>
          <div class="mb-6 px-5 py-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-600 text-sm font-semibold">
            ✓ Mensagem enviada! Retorno assim que possível.
          </div>
        <?php elseif ( $aqgoes_error ) : ?>
          <div class="mb-6 px-5 py-4 rounded-xl bg-red-500/10 border border-red-500/30 text-red-600 text-sm font-semibold">
            <?php echo esc_html( $aqgoes_error ); ?>
          </div>
        <?php endif; ?>

        <form method="post" action="" class="space-y-5">
          <?php wp_nonce_field( 'aqgoes_contact_form', 'aqgoes_contact_nonce' ); ?>
          <input type="text" name="aqgoes_website" value="" autocomplete="off" tabindex="-1" style="position:absolute;left:-9999px;" aria-hidden="true"/>

          <div>
            <label for="aqgoes_name" class="block text-xs font-semibold text-primary mb-1.5">Nome</label>
            <input type="text" id="aqgoes_name" name="aqgoes_name" required
              value="<?php echo isset( $_POST['aqgoes_name'] ) ? esc_attr( wp_unslash( $_POST['aqgoes_name'] ) ) : ''; ?>"
              class="w-full px-4 py-3 rounded-xl bg-secondary border border-subtle text-primary text-sm focus:outline-none focus:border-brand transition-colors"/>
          </div>

          <div>
            <label for="aqgoes_email" class="block text-xs font-semibold text-primary mb-1.5">E-mail</label>
            <input type="email" id="aqgoes_email" name="aqgoes_email" required
              value="<?php echo isset( $_POST['aqgoes_email'] ) ? esc_attr( wp_unslash( $_POST['aqgoes_email'] ) ) : ''; ?>"
              class="w-full px-4 py-3 rounded-xl bg-secondary border border-subtle text-primary text-sm focus:outline-none focus:border-brand transition-colors"/>
          </div>

          <div>
            <label for="aqgoes_subject" class="block text-xs font-semibold text-primary mb-1.5">Assunto</label>
            <input type="text" id="aqgoes_subject" name="aqgoes_subject"
              value="<?php echo isset( $_POST['aqgoes_subject'] ) ? esc_attr( wp_unslash( $_POST['aqgoes_subject'] ) ) : ''; ?>"
              class="w-full px-4 py-3 rounded-xl bg-secondary border border-subtle text-primary text-sm focus:outline-none focus:border-brand transition-colors"/>
          </div>

          <div>
            <label for="aqgoes_message" class="block text-xs font-semibold text-primary mb-1.5">Mensagem</label>
            <textarea id="aqgoes_message" name="aqgoes_message" rows="6" required
              class="w-full px-4 py-3 rounded-xl bg-secondary border border-subtle text-primary text-sm focus:outline-none focus:border-brand transition-colors resize-y"
            ><?php echo isset( $_POST['aqgoes_message'] ) ? esc_textarea( wp_unslash( $_POST['aqgoes_message'] ) ) : ''; ?></textarea>
          </div>

          <button type="submit" class="px-6 py-3.5 rounded-xl bg-brand text-white font-semibold text-sm hover:bg-brand-hover transition-all shadow-md">
            Enviar mensagem
          </button>
        </form>
      </div>

      <!-- Info -->
      <div class="lg:col-span-5">
        <div class="rounded-3xl border border-subtle bg-secondary p-6 sm:p-8 space-y-6">

          <div class="flex items-start gap-4">
            <span class="w-10 h-10 rounded-xl bg-brand/10 text-brand flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </span>
            <div>
              <div class="text-xs uppercase tracking-wide text-muted font-bold">E-mail</div>
              <div class="text-sm text-primary font-semibold mt-0.5"><?php echo esc_html( get_option( 'admin_email' ) ); ?></div>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <span class="w-10 h-10 rounded-xl bg-brand/10 text-brand flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </span>
            <div>
              <div class="text-xs uppercase tracking-wide text-muted font-bold">Localização</div>
              <div class="text-sm text-primary font-semibold mt-0.5">Brasília, DF</div>
            </div>
          </div>

          <div class="flex items-start gap-4">
            <span class="w-10 h-10 rounded-xl bg-brand/10 text-brand flex items-center justify-center flex-shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </span>
            <div>
              <div class="text-xs uppercase tracking-wide text-muted font-bold">Tempo de resposta</div>
              <div class="text-sm text-primary font-semibold mt-0.5">Até 2 dias úteis</div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</main>

<?php get_footer(); ?>
