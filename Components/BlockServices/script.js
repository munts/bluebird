export default function (el) {
  function equalizeCardHeights () {
    const cards = el.querySelectorAll('.item-inner')
    cards.forEach((c) => c.style.removeProperty('min-block-size'))
    const max = Math.max(...Array.from(cards).map((c) => c.offsetHeight))
    cards.forEach((c) => (c.style.minBlockSize = max + 'px'))
  }

  equalizeCardHeights()
  window.addEventListener('resize', equalizeCardHeights)
}
