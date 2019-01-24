Feature: Get Version
  As a system version
  I want to know what version and who is developer

  Scenario: 
    When I typed VER in any directory
    Then I should know what is current version this OS as Fixed text
    
    When I typed VER /w outputs same as VER but also outputs the name (surname and name) and email of the developers. 
    Every developers name and email is listed on a new line.