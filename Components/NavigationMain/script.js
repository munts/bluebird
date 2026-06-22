export default function (el) {
  const isDesktopMediaQuery = window.matchMedia('(min-width: 1024px)')
  isDesktopMediaQuery.addEventListener('change', onBreakpointChange)

  onBreakpointChange()

  function onBreakpointChange () {
    if (isDesktopMediaQuery.matches) {
      setScrollPaddingTop()
    }
  }

  function setScrollPaddingTop () {
    const navHeight = el.offsetHeight
    const adminBarHeight = document.getElementById('wpadminbar')
      ? document.getElementById('wpadminbar').offsetHeight
      : 0
    document.documentElement.style.scrollPaddingTop = `${navHeight + adminBarHeight - 60}px`
  }

  // Estimate modal
  const estimateBtn = el.querySelector('[data-ref="estimateBtn"]')
  const estimateModal = el.querySelector('[data-ref="estimateModal"]')
  const modalClose = el.querySelector('[data-ref="modalClose"]')
  const modalOverlay = el.querySelector('[data-ref="modalOverlay"]')

  if (estimateBtn && estimateModal) {
    estimateBtn.addEventListener('click', openModal)
    modalClose.addEventListener('click', closeModal)
    modalOverlay.addEventListener('click', closeModal)
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal()
    })
  }

  function openModal () {
    estimateModal.setAttribute('aria-hidden', 'false')
    document.body.style.overflow = 'hidden'
    modalClose.focus()
  }

  function closeModal () {
    estimateModal.setAttribute('aria-hidden', 'true')
    document.body.style.overflow = ''
    estimateBtn.focus()
  }
}
