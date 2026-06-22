import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock'
import delegate from 'delegate-event-listener'
import { buildRefs } from '@/assets/scripts/helpers.js'

export default function (el) {
  let isMenuOpen
  const refs = buildRefs(el)
  const navigationHeight = parseInt(window.getComputedStyle(el).getPropertyValue('--navigation-height')) || 0

  const isDesktopMediaQuery = window.matchMedia('(min-width: 1024px)')
  isDesktopMediaQuery.addEventListener('change', onBreakpointChange)

  const menuButtonClickDelegate = delegate('[data-ref="menuButton"]', onMenuButtonClick)
  el.addEventListener('click', menuButtonClickDelegate)

  const submenuToggleDelegate = delegate('[data-ref="submenuToggle"]', onSubmenuToggle)
  el.addEventListener('click', submenuToggleDelegate)

  onBreakpointChange()

  function onMenuButtonClick (e) {
    isMenuOpen = !isMenuOpen
    refs.menuButton.setAttribute('aria-expanded', isMenuOpen)

    if (isMenuOpen) {
      el.setAttribute('data-status', 'menuIsOpen')
      disableBodyScroll(refs.menu)
    } else {
      el.removeAttribute('data-status')
      enableBodyScroll(refs.menu)
      closeAllSubmenus()
    }
  }

  function onSubmenuToggle (e) {
    const button = e.delegateTarget
    const item = button.closest('.item')
    const submenu = item.querySelector('.submenu')
    const isExpanded = button.getAttribute('aria-expanded') === 'true'

    if (isExpanded) {
      button.setAttribute('aria-expanded', 'false')
      submenu.style.blockSize = '0'
    } else {
      button.setAttribute('aria-expanded', 'true')
      submenu.style.blockSize = submenu.scrollHeight + 'px'
    }
  }

  function closeAllSubmenus () {
    el.querySelectorAll('[data-ref="submenuToggle"]').forEach((button) => {
      button.setAttribute('aria-expanded', 'false')
      const submenu = button.closest('.item').querySelector('.submenu')
      if (submenu) submenu.style.blockSize = '0'
    })
  }

  function onBreakpointChange () {
    if (!isDesktopMediaQuery.matches) {
      setScrollPaddingTop()
    }
  }

  function setScrollPaddingTop () {
    const scrollPaddingTop = document.getElementById('wpadminbar')
      ? navigationHeight + document.getElementById('wpadminbar').offsetHeight
      : navigationHeight
    document.documentElement.style.scrollPaddingTop = `${scrollPaddingTop}px`
  }

  return () => {
    isDesktopMediaQuery.removeEventListener('change', onBreakpointChange)
    el.removeEventListener('click', menuButtonClickDelegate)
    el.removeEventListener('click', submenuToggleDelegate)
  }
}
