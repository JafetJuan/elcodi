<?php

namespace Elcodi\Component\Language\Entity\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Elcodi\Component\Language\Entity\Interfaces\LanguageInterface;

/**
 * File header placeholder
 */
trait WithLanguagesTrait
{
    /**
     * @var Collection
     *
     * Languages
     */
    protected $languages;

    /**
     * @var LanguageInterface
     *
     * Main language
     */
    protected $mainLanguage;

    /**
     * Get languages
     *
     * @return Collection
     */
    public function getLanguages() : Collection
    {
        $this->promoteMainLanguage();

        return $this->languages;
    }

    /**
     * Get language isos
     *
     * @return string[]
     */
    public function getLanguageIsos() : array
    {
        return array_map(function(LanguageInterface $language) {
            return $language->getIso();
        }, $this
            ->languages
            ->toArray()
        );
    }

    /**
     * Set languages
     *
     * @param Collection $languages
     */
    public function setLanguages(Collection $languages)
    {
        $this->languages = $languages;
    }

    /**
     * Add language
     *
     * @param LanguageInterface $language
     */
    public function addLanguage(LanguageInterface $language)
    {
        if ($this
            ->languages
            ->contains($language)
        ) {
            return;
        }

        if (!$this->mainLanguage instanceof LanguageInterface) {
            $this->setMainLanguage($language);
        }

        $this
            ->languages
            ->add($language);
    }

    /**
     * Remove language
     *
     * @param LanguageInterface $language
     */
    public function removeLanguage(LanguageInterface $language)
    {
        $this
            ->languages
            ->removeElement($language);

        if ($this->mainLanguage === $language) {
            $this->mainLanguage = $this
                ->languages
                ->isEmpty()
                ? null
                : $this
                    ->languages
                    ->first();
        }
    }

    /**
     * Get MainLanguage
     *
     * @return null|LanguageInterface
     */
    public function getMainLanguage() : ? LanguageInterface
    {
        return $this->mainLanguage;
    }

    /**
     * Set MainLanguage
     *
     * @param LanguageInterface $mainLanguage
     */
    public function setMainLanguage(LanguageInterface $mainLanguage)
    {
        if (!$this
            ->languages
            ->contains($mainLanguage)
        ) {
            return;
        }

        $this->mainLanguage = $mainLanguage;
    }

    /**
     * Promote main language
     */
    private function promoteMainLanguage()
    {
        $this->removeLanguage($this->mainLanguage);
        $this->setLanguages(new ArrayCollection(array_merge(
            [$this->mainLanguage],
            $this->languages
        )));
    }
}