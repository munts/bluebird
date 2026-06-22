const components = document.querySelectorAll('flynt-component[name="GridStaff"]')
components.forEach(initGridStaff)

function initGridStaff (component) {
  const overlay = component.querySelector('[data-modal-overlay]')
  let activeModal = null
  let activeTrigger = null

  // Open on card trigger click
  component.addEventListener('click', (e) => {
    const trigger = e.target.closest('[data-modal-open]')
    if (trigger) {
      const id = trigger.dataset.modalOpen
      const modal = component.querySelector(`[data-modal="${id}"]`)
      if (modal) openModal(modal, trigger)
      return
    }

    // Close on close button
    if (e.target.closest('[data-modal-close]')) {
      closeModal()
    }
  })

  // Close on overlay click
  overlay.addEventListener('click', closeModal)

  // Close on Escape
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && activeModal) closeModal()
  })

  function openModal (modal, trigger) {
    activeModal = modal
    activeTrigger = trigger

    modal.removeAttribute('hidden')
    overlay.removeAttribute('hidden')
    document.body.style.setProperty('overflow', 'hidden')

    // Focus the close button for accessibility
    const closeBtn = modal.querySelector('[data-modal-close]')
    if (closeBtn) closeBtn.focus()

    // Trap focus inside modal
    modal.addEventListener('keydown', trapFocus)
  }

  function closeModal () {
    if (!activeModal) return

    activeModal.setAttribute('hidden', '')
    overlay.setAttribute('hidden', '')
    document.body.style.removeProperty('overflow')
    activeModal.removeEventListener('keydown', trapFocus)

    if (activeTrigger) activeTrigger.focus()
    activeModal = null
    activeTrigger = null
  }

  function trapFocus (e) {
    if (e.key !== 'Tab') return
    const focusable = Array.from(
      activeModal.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])')
    ).filter(el => !el.disabled && el.offsetParent !== null)

    if (!focusable.length) return

    const first = focusable[0]
    const last = focusable[focusable.length - 1]

    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault()
      last.focus()
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault()
      first.focus()
    }
  }
}
