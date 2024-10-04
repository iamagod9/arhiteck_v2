<div class="modal fade feedback-modal" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="modal-body form-feedback-modal" action="{{ route('consultation') }}" method="POST">
          @csrf
          <input type="hidden" name="is_modal" value="1">
        <div class="row g-3 mb-3">
          <div class="col-12 col-md-6">
            <div class="form-floating">
              <input class="form-control" id="nameInput" placeholder="Ваше имя" name="name_modal_feedback" />
              <label for="nameInput">Ваше имя</label>
              <div class="invalid-tooltip">Укажите, пожалуйста, корректное имя.</div>
            </div>
          </div>

          <div class="col-12 col-md-6">
            <div class="form-floating">
              <input class="form-control" id="phoneInput" type="tel" name="phone_modal_feedback" data-tel-input placeholder="Ваш номер" />
              <label for="phoneInput">Ваш номер</label>
              <div class="invalid-tooltip">Укажите, пожалуйста, корректный номер телефона.</div>
            </div>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary w-100 py-2">
              <span class="spinner-border spinner-border-sm me-1 d-none" role="status" aria-hidden="true"></span>
              Получить консультацию
            </button>
          </div>
        </div>

        <p class="mb-0">
          Нажимая кнопку, вы соглашаетесь на обработку
          <a href="{{ route('personal-data') }}" class="fw-medium border-bottom">персональных данных</a>
        </p>
      </form>
      <div class="modal-footer-feedback m-0 justify-content-center column-gap-3 p-3 pt-0">
        <div class="modal-footer-feedback__title mb-2">
          <span class="modal-footer-feedback__title-line"></span>
          <p class="mb-0">или напишите</p>
          <span class="modal-footer-feedback__title-line"></span>
        </div>
        <div class="d-flex column-gap-3 justify-content-center">
          <a href="#" class=""><i class="fa-brands fa-vk"></i></a>
          <a href="#" class=""><i class="fa-brands fa-telegram"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>