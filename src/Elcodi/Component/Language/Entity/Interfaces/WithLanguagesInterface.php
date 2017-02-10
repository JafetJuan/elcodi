<?php
/**
 * File header placeholder
 */

namespace Elcodi\Component\Language\Entity\Interfaces;


use Doctrine\Common\Collections\Collection;

interface WithLanguagesInterface
{
    /**
     * Get languages
     *
     * @return Collection
     */
    public function getLanguages() : Collection;

    /**
     * Set languages
     *
     * @param Collection $languages
     */
    public function setLanguages(Collection $languages);

    /**
     * Add language
     *
     * @param LanguageInterface $language
     */
    public function addLanguage(LanguageInterface $language);

    /**
     * Remove language
     *
     * @param LanguageInterface $language
     */
    public function removeLanguage(LanguageInterface $language);

    /**
     * Get MainLanguage
     *
     * @return null|LanguageInterface
     */
    public function getMainLanguage() : ? LanguageInterface;

    /**
     * Set MainLanguage
     *
     * @param LanguageInterface $mainLanguage
     */
    public function setMainLanguage(LanguageInterface $mainLanguage);
}