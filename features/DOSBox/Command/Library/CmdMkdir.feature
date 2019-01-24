Feature: Make Directory
  As a system directory
  I want to create directory

  Scenario: create directory
    Given drive C have files and dirs
     When I typed MKDIR <directoryname>