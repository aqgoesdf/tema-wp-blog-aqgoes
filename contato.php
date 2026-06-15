/*
    Template Name: Página Contato Blog AqGoEs
*/
<?php get_header(); ?>
  <main>

    <!-- PAGE HERO -->
    <section class="page-hero">
      <div class="container">
        <span class="hero__tag">✉️ Fale conosco</span>
        <h1>Entre em <em>Contato</em></h1>
        <p>Dúvidas, sugestões, parcerias ou só um alô? Estamos aqui.</p>
      </div>
    </section>

    <!-- CONTATO GRID: Formulário + Info -->
    <section class="contact section-pad">
      <div class="container contact__grid">

        <!-- ===== FORMULÁRIO PRINCIPAL ===== -->
        <!--
          CONCEITO DE ACESSIBILIDADE:
          - Todo input tem um <label> associado via "for" e "id"
          - aria-describedby conecta o input à mensagem de erro
          - aria-invalid indica estado de erro para leitores de tela
          - role="alert" na mensagem de sucesso garante anúncio imediato
        -->
        <div class="contact__form-wrapper">
          <h2>Envie uma mensagem</h2>

          <form class="contact__form" id="contactForm" novalidate>

            <!-- Campo: Nome -->
            <div class="form__group" id="groupNome">
              <label for="nome" class="form__label">
                Nome completo <span class="form__required" aria-hidden="true">*</span>
              </label>
              <input
                type="text"
                id="nome"
                name="nome"
                class="form__input"
                placeholder="Seu nome"
                autocomplete="name"
                required
                aria-describedby="nomeError"
                aria-invalid="false"
              />
              <span class="form__error" id="nomeError" role="alert"></span>
            </div>

            <!-- Campo: E-mail -->
            <div class="form__group" id="groupEmail">
              <label for="email" class="form__label">
                E-mail <span class="form__required" aria-hidden="true">*</span>
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

            <!-- Campo: Assunto -->
            <div class="form__group" id="groupAssunto">
              <label for="assunto" class="form__label">
                Assunto <span class="form__required" aria-hidden="true">*</span>
              </label>
              <select
                id="assunto"
                name="assunto"
                class="form__input form__select"
                required
                aria-describedby="assuntoError"
                aria-invalid="false"
              >
                <option value="">Selecione um assunto...</option>
                <option value="duvida">Dúvida técnica</option>
                <option value="sugestao">Sugestão de conteúdo</option>
                <option value="parceria">Parceria / Colaboração</option>
                <option value="erro">Reportar erro</option>
                <option value="outro">Outro</option>
              </select>
              <span class="form__error" id="assuntoError" role="alert"></span>
            </div>

            <!-- Campo: Mensagem -->
            <div class="form__group" id="groupMensagem">
              <label for="mensagem" class="form__label">
                Mensagem <span class="form__required" aria-hidden="true">*</span>
              </label>
              <textarea
                id="mensagem"
                name="mensagem"
                class="form__input form__textarea"
                placeholder="Escreva sua mensagem aqui..."
                rows="5"
                required
                minlength="20"
                aria-describedby="mensagemError mensagemCount"
                aria-invalid="false"
              ></textarea>
              <div class="form__textarea-footer">
                <span class="form__error" id="mensagemError" role="alert"></span>
                <span class="form__char-count" id="mensagemCount">0 / 500 caracteres</span>
              </div>
            </div>

            <!-- Honeypot (anti-spam) - escondido via CSS, não via display:none -->
            <div class="form__group form__honeypot" aria-hidden="true">
              <label for="website">Website (não preencha)</label>
              <input type="text" id="website" name="website" tabindex="-1" autocomplete="off" />
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn--primary btn--full" id="submitBtn">
              <span class="btn__text">Enviar mensagem</span>
              <span class="btn__loading hidden">Enviando...</span>
            </button>

          </form>

          <!-- Feedback de sucesso -->
          <div class="form__success hidden" id="formSuccess" role="alert" aria-live="assertive">
            <div class="success__icon">✅</div>
            <h3>Mensagem enviada!</h3>
            <p>Recebemos seu contato e responderemos em até 48 horas. Obrigado!</p>
            <button class="btn btn--ghost" id="newMessageBtn">Enviar outra mensagem</button>
          </div>
        </div>

        <!-- ===== INFORMAÇÕES DE CONTATO ===== -->
        <aside class="contact__info">
          <h2>Outras formas de falar com a gente</h2>

          <div class="contact__info-list">

            <div class="contact__info-item">
              <div class="contact__info-icon">📧</div>
              <div>
                <strong>E-mail</strong>
                <p>contato@techpulse.dev</p>
              </div>
            </div>

            <div class="contact__info-item">
              <div class="contact__info-icon">💬</div>
              <div>
                <strong>Discord</strong>
                <p>discord.gg/techpulse</p>
              </div>
            </div>

            <div class="contact__info-item">
              <div class="contact__info-icon">🐙</div>
              <div>
                <strong>GitHub</strong>
                <p>github.com/techpulse</p>
              </div>
            </div>

            <div class="contact__info-item">
              <div class="contact__info-icon">⏰</div>
              <div>
                <strong>Tempo de resposta</strong>
                <p>Geralmente dentro de 48 horas úteis</p>
              </div>
            </div>

          </div>

          <!-- FAQ rápido -->
          <div class="contact__faq">
            <h3>Perguntas frequentes</h3>

            <details class="faq__item">
              <summary>Posso sugerir um tema de artigo?</summary>
              <p>Sim! Use o formulário e selecione "Sugestão de conteúdo". Adoramos receber ideias da comunidade.</p>
            </details>

            <details class="faq__item">
              <summary>Como me tornar autor?</summary>
              <p>Entre em contato via e-mail com alguns exemplos do seu trabalho. Analisamos todas as propostas.</p>
            </details>

            <details class="faq__item">
              <summary>O conteúdo é sempre gratuito?</summary>
              <p>Sim! Todo o conteúdo do TechPulse é gratuito e sempre será. Somos sustentados pela comunidade.</p>
            </details>
          </div>

        </aside>

      </div>
    </section>

  </main>


<?php get_footer(); ?>